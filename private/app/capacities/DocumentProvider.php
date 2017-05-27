<?php

/**
 * Class DocumentProvider
 *
 * Responsible for delivering a fully assembled/rendered HTML document
 * (the <html> tag).
 */
class DocumentProvider
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
     * @return string
     */
    public function getDocument()
    {
        $resource_manifest = $this
            ->processManager->getInstruction('resource-manifest');
        $apsSetup = $this->processManager->getConfig('apsSetup');

        $tools = $this->capacities->get('tools');

        $page_payload = $this
            ->capacities
            ->get('content-provider')
            ->getContent();

        $page_variables = [
            'page_header_content' => 'This is the page header content.',
            'page_payload' => $page_payload,
            'page_footer_content' => 'This is the page footer content.',
        ];

        $body_content = '';
        $body_content .= $tools->render('page', $page_variables);
        $body_content .= $this->provideAppMenu();

        $document_variables = [
            'html_language' => $apsSetup['defaults']['document_properties']['html_lang'],
            'head_title' => $apsSetup['defaults']['document_properties']['head_title'],
            'stylesheets' => $this->provideStylesheets(),
            'body_classes' => $this->calculateBodyClasses(),
            'body_content' => $body_content,
        ];
        return $tools->render('document', $document_variables);
    }

    protected function calculateBodyClasses()
    {
        // TODO.
        return 'body-class';
    }

    protected function documentHeadAdditions(&$document_variables)
    {

    }

    public function renderStylesheetLink($href, $cache_bust_str)
    {
        $sec = $this->capacities->get('security');

        return $this->capacities->get('tools')->render(
            'app-infra/stylesheet-link',
            [
                'href' => $sec->escapeValue($href, 'href'),
                'cache_bust_str' => $sec->escapeValue($cache_bust_str, 'cache_bust_str'),
            ],
            'php'
        );

    }

    public function renderScriptTag($src, $opts = [])
    {

    }

    /**
     * Renders stylesheet links or script tags.
     *
     * @param $assets
     * @param $kind
     * @param $output
     */
    private function frontendAssetsRenderer($assets, $kind, &$output)
    {
        $assets_config = $this
            ->processManager
            ->getConfig('config')['frontend-assets'];
        $base_url = $this->processManager->getInstruction('base-url');
        $path_to_theme_assets = $this
            ->processManager
            ->getInstruction('url-path-to-theme-assets');
        // $path_to_app_assets = ''; // TODO.
        $cache_bust_str = $assets_config['cache-bust-str'];

        foreach ($assets as $key => $val) {

            if (strpos($key, 'theme') !== false) {

                // If the file is located in the theme:

                $val = $base_url
                    . $path_to_theme_assets
                    . '/'
                    . $val;

            } elseif (strpos($key, 'app') !== false) {

                // If the file is located in the app assets location:

                // TODO.

            }

            if (!empty($val)) {

                if ($kind == 'styles') {
                    $output .= $this->renderStylesheetLink($val, $cache_bust_str);
                }
                elseif ($kind == 'scripts') {
                    // TODO.
                    // $output .= $this->renderScriptTag($val, $cache_bust_str);
                }

            }
        }
        unset($key, $val);
    }

    private function provideJsSettingsObjects()
    {

    }

    /**
     * Provides a series of stylesheet links for the app as one rendered string.
     *
     * @return string
     */
    public function provideStylesheets()
    {

        $stylesheets = $this
            ->processManager
            ->getConfig('config')['frontend-assets']['stylesheets'];

        $output = '';
        if (!empty($stylesheets)) {
            $this->frontendAssetsRenderer($stylesheets, 'styles', $output);
        }
        return $output;
    }

    public function provideScripts($location)
    {

    }

    /**
     * Provide rendered app menu.
     *
     * @return string
     */
    public function provideAppMenu() {
        $pagelist = $this->processManager->getConfig('routes');
        $sec = $this->capacities->get('security');

        $app_menu_items = [];

        foreach ($pagelist as $path => $page_data) {

            // We were called during a dynamic php page response.
            if (! defined('BUILDING_STATIC_FILE') || empty(BUILDING_STATIC_FILE)) {

                $url = $this
                    ->processManager
                    ->getInstruction('base-url')
                    . $sec->escapeValue($path, 'uri_path');

            } else {
                // We were called while generating a static site.

                // For the static site, include only the anypages in the menu.
                if ($page_data['resource-type'] != 'anypage') {
                    continue;
                }

                $url = $sec
                    ->escapeValue($page_data['html-file_name'], 'filename')
                    . '.html';
            }

            $app_menu_items[] = [
                'url' => $url,
                'text' => $sec->escapeValue($page_data['menu-link-text']),
            ];
        }

        return $this
            ->capacities
            ->get('tools')
            ->render('app-infra/app-menu', compact('app_menu_items'), 'php');
    }
}
