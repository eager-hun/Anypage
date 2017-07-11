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

    public function getContent()
    {
        // This is the default content. If we cover something, we will overwrite
        // it.
        $output = 'You have found an unfinished feature here.';

        $manifest = $this->processManager->getInstruction('resource-manifest');

        if ($manifest['resource-type'] == 'anypage'
            || $manifest['resource-type'] == 'metapage') {

            $recipe_subdir = 'anypage-recipes'; // Assume anypage by default.

            if ($manifest['resource-type'] == 'metapage') {
                $recipe_subdir = 'metapage-recipes';
            }

            $recipe_file = APS_DEFINITIONS
                . '/' . $recipe_subdir . '/'
                . $manifest['resource-id']
                . '.recipe.php';

            if (file_exists($recipe_file)) {

                // Let's make helper stuffs available for page recipes.
                $tools  = $this->capacities->get('tools');

                // Bring in page's content.
                ob_start();
                include($recipe_file);
                $output = ob_get_clean();
            } else {
                // TODO: error handling?
                $output = 'Error: content recipe was not found.';
            }

        } elseif ($manifest['resource-type'] == 'system_page') {

            if ($manifest['resource-id'] == '404') {
                $output = $this->message404();
                $this
                    ->processManager
                    ->setInstruction('http-response-code', '404', true);
            } elseif ($manifest['resource-id'] == 'generator') {

            } elseif ($manifest['resource-id'] == 'list_generated') {
                $page_title_text = 'Generated static snapshots';

                $output = $this
                    ->capacities
                    ->get('tools')
                    ->render(
                        'app-infra/page-title',
                        compact('page_title_text'),
                        'php'
                    );

                $output .= $this
                    ->capacities
                    ->get('site-generator')
                    ->listGeneratedStaticSites();
            }
        }
        else {
            // TODO: error handling?
            $output = 'Error: unrecognized resource type got requested.';
        }

        return $output;
    }

    protected function message404()
    {
        return 'The requested resource was not found on this website.';
    }
}
