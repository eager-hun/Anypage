<?php

/**
 * Class ContentProvider
 *
 * Responsible for delivering the (rendered) payload of a response (page).
 */
class ContentProvider
{

    protected $processManager;
    protected $capacities;

    public function __construct(
        ProcessManager $processManager,
        Capacities $capacities
    )
    {
        $this->processManager = $processManager;
        $this->capacities = $capacities;
    }

    /**
     * Provides page content.
     *
     * @return string
     */
    public function getContent()
    {
        // This is the default content. If we cover something, we will overwrite
        // it.
        $output = 'You have found an unfinished feature here.';

        $manifest = $this->processManager->getInstruction('resource-manifest');

        if (!array_key_exists('resource-type', $manifest)
            || $manifest['resource-type'] == 'anypage') {

            $recipe_subdir = 'anypage-recipes';

            $recipe_file = APS_DEFINITIONS
                . '/' . $recipe_subdir . '/'
                . $manifest['resource-id'] . '.recipe.php';

            if (file_exists($recipe_file)) {

                // Let's make helper stuffs available for page recipes.
                $tools  = $this->capacities->get('tools');

                // Make custom functions available for page recipes.
                $anypage_functions = ANYPAGES . '/functions.php';
                if (file_exists($anypage_functions)) {
                    include_once($anypage_functions);
                }

                // Bring in the page's content.
                ob_start();
                include($recipe_file);
                $output = ob_get_clean();

            } else {

                // TODO: error handling?
                $msg = 'Error: the content recipe was not found.';
                $this->processManager->sysNotify($msg, 'alert');
                $output = '';

            }

        } elseif ($manifest['resource-type'] == 'system_page') {

            if ($manifest['resource-id'] == '404') {

                $output = $this->message404();
                $this->processManager->setInstruction(
                    'http-response-code-suggestion',
                    '404',
                    true
                );

            } elseif ($manifest['resource-id'] == 'generator') {

                $output = $this->generatorPageContent();

            } elseif ($manifest['resource-id'] == 'list_generated') {

                $output = $this->staticSiteListingPageContent();

            }
        }
        else {
            // TODO: error handling?
            $output = 'Error: unrecognized resource type got requested.';
        }

        return $output;
    }

    /**
     * Page content for the 404 page.
     *
     * @return string
     */
    protected function message404()
    {
        return 'The requested resource was not found on this website.';
    }

    /**
     * Provides UI for the site generator feature.
     *
     * @return string
     */
    protected function generatorPageContent()
    {
        $page_title_text = 'Generate static site';

        $output = $this
            ->capacities
            ->get('tools')
            ->render(
                'app-infra/page-title',
                compact('page_title_text'),
                'php'
            );

        $output .= $this->capacities->get('site-generator')->generatorUI();

        return $output;
    }

    /**
     * Provides UI for the site listing page.
     *
     * @return string
     */
    protected function staticSiteListingPageContent()
    {
        $page_title_text = 'Generated static snapshots';

        $output = $this->capacities
            ->get('tools')
            ->render(
                'app-infra/page-title',
                compact('page_title_text'),
                'php'
            );

        $output .= $this->capacities
            ->get('site-generator')
            ->listGeneratedStaticSites();

        return $output;
    }
}
