<?php

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

    public function __construct(
        ProcessManager $processManager,
        Capacities $capacities
    )
    {
        $this->processManager = $processManager;
        $this->capacities = $capacities;
        $this->sec = $capacities->get('security');
        $this->env_config = $processManager->getConfig('config')['env'];
    }

    public function listGeneratedStaticSites() {
        $exports_dir_name = $this
            ->sec
            ->escapeValue(
                $this->env_config['html-export-dir'],
                'dir_name'
            );

        $exports_dir_for_server = PUBLIC_ASSETS . '/' . $exports_dir_name;

        // FIXME: Make it possible that the 'public/' subpath doesn't need to be
        // hardcoded like this. Create a config var or a ProcessManager
        // instruction, from where it could be read.
        $exports_dir_for_client = $this
            ->processManager
            ->getInstruction('base-url')
            . 'public/'
            . $exports_dir_name;

        $ls_result = [];
        $directory_manifest = [];

        // FIXME: replace direct shell accesses with php filesystem functions.
        exec(
            'ls ' . escapeshellarg($exports_dir_for_server),
            $ls_result
        );

        foreach($ls_result as $value) {
            if (is_dir($exports_dir_for_server . '/' . $value)) {

                $link_href =
                    $exports_dir_for_client
                    . '/'
                    . $this->sec->escapeValue($value, 'dir_name');

                $link_text = $this->sec->escapeValue($value, 'dir_name');

                $directory_manifest[] = [
                    'link_href' => $link_href,
                    'link_text' => $link_text
                ];
            }
        }
        unset($value);

        $output = $this
            ->capacities
            ->get('tools')
            ->render('app-infra/listing-generated', compact('directory_manifest'), 'php');

        return $output;
    }

    public function savePageAsHTML($Request, $Response, $ApsSetup, $ProcessInfo, $document)
    {

    }
}
