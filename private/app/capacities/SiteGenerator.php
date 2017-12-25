<?php

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Finder\Finder;


/**
 * Class SiteGenerator
 *
 * Responsible for
 * - providing the generator page UI (with the "Generate" button, and the
 *   triggering javascript),
 * - creating generated static html sites (one page per request),
 * - providing the directory listing of the directory of generated static sites.
 */
class SiteGenerator
{
    protected $processManager;
    protected $capacities;
    protected $sec;
    protected $env_config;
    protected $filesystem;

    protected $pathToTheme;
    protected $pathToAppAssets;
    protected $staticExportsDirName;
    protected $newSiteInstanceFsPath;

    public function __construct(
        ProcessManager $processManager,
        Capacities $capacities
    )
    {
        $this->processManager   = $processManager;
        $this->capacities       = $capacities;
        $this->sec              = $capacities->get('security');
        $this->env_config       = $processManager->getConfig('config')['env'];
        $this->filesystem       = new Filesystem;

        $this->pathToTheme = $this
            ->processManager->getInstruction('path-fragment-to-theme');

        $this->pathToAppAssets = $this
            ->processManager->getInstruction('path-fragment-to-app-assets');

        $this->staticExportsDirName = $this
            ->sec
            ->escapeValue($this->env_config['html-export-dir-name'], 'dir-name');
    }


    /**
     * Provides the absolute filesystem path to the new static site instance.
     * 
     * @return string
     * @throws HttpException
     */
    protected function getNewSiteInstanceFsPath()
    {
        if (!empty($this->newSiteInstanceFsPath)) {
            return $this->newSiteInstanceFsPath;
        }

        $destination_subdir = $this
            ->processManager->request->query->get('dir');

        // Validations.

        if (empty($destination_subdir)) {
            $message = 'No destination subdirectory was specified; aborting.';
            throw new HttpException($message, 400);
        }
        elseif (!$this->sec->stringValidAs($destination_subdir, 'new-dir-name')) {
            $message = 'The provided destination subdirectory name was not valid; aborting.';
            throw new HttpException($message, 400);
        }

        $this->newSiteInstanceFsPath = PUBLIC_RESOURCES
            . DIRECTORY_SEPARATOR
            . $this->staticExportsDirName
            . DIRECTORY_SEPARATOR
            . $this->sec->escapeValue($destination_subdir, 'dir-name');

        return $this->newSiteInstanceFsPath;
    }


    /**
     * Lists the URLs of the pages that need to make it into the static site.
     *
     * @return array
     */
    public function staticSitePageUrlList()
    {
        $base_url = $this->processManager->getInstruction('base-url');
        $pagelist = $this->processManager->getConfig('routes');
        $page_urls = [];

        foreach ($pagelist as $path => $page_manifest) {
            if (!empty($page_manifest['html-filename'])) {
                $page_urls[] = $base_url . $path;
            }
        }
        unset($path, $page_manifest);

        return $page_urls;
    }


    /**
     * Provides rendered list of found static site instances.
     *
     * @return string
     */
    public function listGeneratedStaticSites() {

        $base_url = $this->processManager->getInstruction('base-url');
        $fragment_to_exports = $this->env_config['path-fragment-to-html-export-dir'];

        $exports_dir_for_server = PUBLIC_RESOURCES
            . DIRECTORY_SEPARATOR
            . $this->staticExportsDirName;

        $exports_dir_for_browser = $base_url
            . $fragment_to_exports
            . '/'
            . $this->staticExportsDirName;

        $finder = new Finder;
        $finder->directories()->in($exports_dir_for_server)->depth('== 0');
        $finder->sortByName();

        $directory_manifest = [];

        foreach($finder->getIterator() as $iterator) {
            $site_dir_name = $iterator->getBasename();

            $link_href =
                $exports_dir_for_browser
                . '/'
                . $this->sec->escapeValue($site_dir_name, 'dir-name');

            $link_text = $this->sec->escapeValue($site_dir_name, 'dir-name');

            $directory_manifest[] = [
                'link_href' => $link_href,
                'link_text' => $link_text
            ];
        }
        unset($iterator);

        $output = $this
            ->capacities
            ->get('tools')
            ->render(
                'app-infra/listing-generated',
                compact('directory_manifest'),
                'php'
            );

        return $output;
    }


    /**
     * Provides generator UI.
     *
     * @return string
     */
    public function generatorUI()
    {
        return $this
            ->capacities
            ->get('tools')
            ->render('app-infra/generator-ui', [], 'php');
    }


    /**
     * Saves the currently being rendered webpage onto disk.
     *
     * @param string $document
     *
     * @return string
     *      Status message.
     */
    public function saveWebPage($document)
    {
        $status = [
            'status-text' => '',
            'http-response-status-suggestion' => 0
        ];
        $error = false;

        if (!file_exists($this->getNewSiteInstanceFsPath())) {
            if (!mkdir($this->getNewSiteInstanceFsPath())) {
                $error = 'The target subdirectory could not be created.';
            }
        }

        if (!empty($error)) {
            return $this->_returnFromPageSaving($status, $error);
        }

        $this->_copySiteFrontendAssets($status, $error);

        if (!empty($error)) {
            return $this->_returnFromPageSaving($status, $error);
        }

        $this->_saveDocumentAsHTML($document, $status, $error);

        return $this->_returnFromPageSaving($status, $error);
    }


    /**
     * Copy a directory recursively with Symfony Filesystem's mirror().
     *
     * @param $from
     * @param $to
     * @param $status
     * @param $error
     */
    protected function _mirrorDirectory($from, $to, &$status, &$error)
    {
        // Copy only if it's not there yet.
        if (!$this->filesystem->exists($to)) {
            try {
                $this->filesystem->mirror($from, $to);
            } catch (IOExceptionInterface $exception) {
                $error = "Could not copy directory at " . $exception->getPath();
            }
        }
    }


    /**
     * Copies frontend asset directories into the new static site instance.
     *
     * @param $status
     * @param $error
     */
    protected function _copySiteFrontendAssets(&$status, &$error)
    {
        $built_assets_dir = DIRECTOR_DIR
            . DIRECTORY_SEPARATOR
            . $this->pathToTheme
            . DIRECTORY_SEPARATOR
            . 'built';

        $built_assets_dir_copy = $this->getNewSiteInstanceFsPath()
            . DIRECTORY_SEPARATOR
            . 'built';

        $this->_mirrorDirectory(
            $built_assets_dir,
            $built_assets_dir_copy,
            $status,
            $error
        );

        if (!empty($error)) {
            return;
        }

        $static_assets_dir = DIRECTOR_DIR
            . DIRECTORY_SEPARATOR
            . $this->pathToTheme
            . DIRECTORY_SEPARATOR
            . 'static-assets';

        $static_assets_dir_copy = $this->getNewSiteInstanceFsPath()
            . DIRECTORY_SEPARATOR
            . 'static-assets';

        $this->_mirrorDirectory(
            $static_assets_dir,
            $static_assets_dir_copy,
            $status,
            $error
        );

        if (!empty($error)) {
            return;
        }

        $app_assets_dir = DIRECTOR_DIR
            . DIRECTORY_SEPARATOR
            . $this->pathToAppAssets;

        $app_assets_dir_copy = $this->getNewSiteInstanceFsPath()
            . DIRECTORY_SEPARATOR
            . 'app-assets';

        $this->_mirrorDirectory(
            $app_assets_dir,
            $app_assets_dir_copy,
            $status,
            $error
        );
    }

    /**
     * Saves the current page as a HTML file onto disk.
     *
     * @param $document
     * @param $status
     * @param $error
     * @throws HttpException
     */
    protected function _saveDocumentAsHTML($document, &$status, &$error)
    {
        $resource_manifest = $this->processManager
            ->getInstruction('resource-manifest');
        $resource_id = $resource_manifest['resource-id'];

        if (empty($resource_manifest['html-filename'])) {
            $message = 'No HTML filename was provided in resource manifest.';
            throw new HttpException($message, 500);
        }

        $filename = $resource_manifest['html-filename'] . '.html';

        $file = $this->getNewSiteInstanceFsPath()
            . DIRECTORY_SEPARATOR
            . $filename;

        if (file_put_contents($file, $document) !== FALSE) {
            $short_message = "Saved page of id: $resource_id";
            $full_message  = $short_message
                . ' to ' . $this->getNewSiteInstanceFsPath() . '/' . $filename;

            $status['status-text'] =
                "<span title='$full_message'>$short_message</span>";

        }
        else {
            $error = 'Failed to save page of id: ' . $resource_id;
        }
    }


    /**
     * Provides the return value for the HTML page saver method.
     *
     * @param $status
     * @param $error
     * @return string
     */
    protected function _returnFromPageSaving($status, $error)
    {
        if (!empty($error)) {
            $status['status-text'] = $error;

            if (!empty($status['http-response-status-suggestion'])) {
                $this->processManager->setInstruction(
                    'http-response-code-suggestion',
                    $status['http-response-status-suggestion'],
                    true
                );
            }
            // If we are in an error state, but no specific reason was provided,
            // let's fall back to 500.
            else {
                $this->processManager->setInstruction(
                    'http-response-code-suggestion',
                    500,
                    true
                );
            }
        }
        elseif (empty($status['status-text'])) {
            $status['status-text'] = "Page saving succeeded.";
        }

        return $status['status-text'];
    }
}
