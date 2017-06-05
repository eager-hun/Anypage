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

        if (empty($resource_manifest['has-own-layout'])) {
            $page_payload = $tools->render(
                'page-level',
                [
                    'wrapper_extra_classes' => 'fallback-page-level',
                    'page_level_content'    => $page_payload
                ]
            );
        }

        $page_variables = [
            'page_header_content'   => 'This is the page header content.',
            'page_payload'          => $page_payload,
            'page_footer_content'   => 'This is the page footer content.',
        ];

        $body_content = '';
        $body_content .= $tools->render('page', $page_variables);
        $body_content .= $this->provideAppMenu();

        $document_variables = [
            'html_language'     =>
                $apsSetup['defaults']['document_properties']['html_lang'],
            'head_title'        =>
                $apsSetup['defaults']['document_properties']['head_title'],
            'head_misc'         => '',
            'stylesheets'       => $this->provideStylesheets(),
            'scripts_in_head'   => $this->provideScripts('head'),
            'body_classes'      => $this->calculateBodyClasses(),
            'body_content'      => $body_content,
            'scripts_in_body'   => $this->provideScripts('body'),
        ];

        $this->documentHeadAdditions($document_variables);

        return $tools->render('document', $document_variables);
    }

    /**
     * @param $document_variables
     */
    protected function documentHeadAdditions(&$document_variables)
    {
        if (!empty($this->processManager->getConfig('config')['enable-livereload'])) {
            // && empty(BUILDING_STATIC_FILE)) {

            // See http://stackoverflow.com/questions/26069796/gulp-how-to-implement-livereload-without-chromes-livereload-plugin
            $livereload_script =
                '<script src="http://localhost:35729/livereload.js?snipver=1"></script>';
            $document_variables['head_misc'] .= PHP_EOL . $livereload_script;
        }
    }

    /**
     * @return string
     */
    protected function calculateBodyClasses()
    {
        $body_classes = [];

        $app_menu_config = $this->processManager->getConfig('config')['app']['app-menu'];
        if (!empty($app_menu_config['is-enabled'])) {
            $body_classes[] = 'app-menu-is-enabled';
        }

        return implode(' ', $body_classes);
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
            $output = $this->renderStylesheets($stylesheets);
        }

        return $output;
    }

    /**
     * Render stylesheets.
     *
     * @param $assets
     * @return string
     */
    public function renderStylesheets($assets)
    {
        $output = '';

        foreach ($assets as $key => $val) {

            if (strpos($key, 'app') !== false) {
                $href = $this->finalizeFrontendAssetUrl($val, 'app');
            } elseif (strpos($key, 'theme') !== false) {
                $href = $this->finalizeFrontendAssetUrl($val, 'theme');
            }

            $output .= $this->capacities->get('tools')->render(
                'app-infra/stylesheet-link',
                ['href' => $href],
                'php'
            );
        }
        unset($key, $val);

        return $output;
    }

    /**
     * Provides a series of script tags for the app as one rendered string.
     *
     * @param $location
     * @return string
     */
    public function provideScripts($location)
    {
        $assets_config = $this
            ->processManager
            ->getConfig('config')['frontend-assets'];

        $scripts = $assets_config['scripts'];

        $output = '';

        if ($assets_config['add-js-settings-object-to'] == $location) {
            $output .= $this->provideJsSettingsObject();
        }

        if (!empty($scripts[$location])) {
            $output .= $this->renderScripts($scripts[$location]);
        }

        return $output;
    }

    /**
     * @param array $scripts
     * @return string
     */
    protected function renderScripts($scripts) {
        $output = '';

        foreach ($scripts as $key => $script_props) {

            $use_as = 'reference'; // Default.

            if (!empty($script_props['use_as'])) {
                $use_as = $script_props['use_as'];
            }

            if ($use_as == 'reference') {

                // We will use an 'src' attribute and the script tag will have
                // no content.

                if (!empty($script_props['script'])) {
                    unset($script_props['script']);
                }

                if (!empty($script_props['file'])) {

                    // If the 'file' key exists, it implies a file in our
                    // filesystem.

                    if (strpos($key, 'app') !== false) {
                        $script_props['src_value'] =
                            $this->finalizeFrontendAssetUrl(
                                $script_props['file'],
                                'app'
                            );
                    } elseif (strpos($key, 'theme') !== false) {
                        $script_props['src_value'] =
                            $this->finalizeFrontendAssetUrl(
                                $script_props['file'],
                                'theme'
                            );
                    }

                } elseif (!empty($script_props['src_value'])) {

                    // If the src_value had been directly set.
                    // TODO.

                    $msg = 'Inlining scripts is TODO.';
                    $this->processManager->sysNotify($msg, 'warning');

                }

            } elseif ($use_as == 'inline') {

                // TODO: file_get_contents().

                $msg = 'Inlining scripts is TODO.';
                $this->processManager->sysNotify($msg, 'warning');

                if (!empty($script_props['file'])) {

                }
            }
            else {
                $msg = 'renderScripts() did not understand the intended script usage suggestion.';
                $this->processManager->sysNotify($msg, 'warning');
                continue;
            }

            $output .= $this->renderScriptTag($script_props);
        }
        unset($key, $script_props);

        return $output;
    }

    /**
     * Render a script tag.
     *
     * @param array $script_props
     *   keys:
     *     'variant': 'reference' || 'inline'
     *     'src_value': src attrib value
     *     'script': script to be inlined
     * @return string
     */
    protected function renderScriptTag($script_props)
    {
        // Defaults.
        $src_attrib = '';
        $script     = '';

        if (!empty($script_props['src_value'])) {
            $src_attrib = ' src="' . $script_props['src_value'] . '"';
        }
        elseif (!empty($script_props['script'])) {
            $script = $script_props['script'];
        }

        return $this->capacities->get('tools')->render(
            'app-infra/script-tag',
            [
                'src_attrib' => $src_attrib,
                'script'     => $script,
            ],
            'php'
        );
    }

    /**
     * Provide JS settings object.
     *
     * @return string
     */
    protected function provideJsSettingsObject()
    {
        $settings_items = array();

        // TODO:
        // if ('this is the generator page' && empty(BUILDING_STATIC_FILE)) {}

        $base_url = $this->processManager->getInstruction('base-url');
        $pagelist = $this->processManager->getConfig('routes');

        $page_urls = [];

        foreach ($pagelist as $path => $page_manifest) {
            if ($page_manifest['resource-type'] == 'anypage') {
                $page_urls[] = $base_url . $path;
            }
        }
        unset($path, $page_manifest);

        $settings_items['anypageUrlList'] = $page_urls;

        $settings = json_encode($settings_items, JSON_FORCE_OBJECT);

        $script = "window.apSettings = $settings;";
        $script .= PHP_EOL;
        $script .= 'window.apAssets = {};';

        $scriptTag = $this->renderScriptTag([
            'script'  => $script
        ]);

        return $scriptTag;
    }

    /**
     * Finalize a frontend asset url.
     *
     * TODO: make processManager->getInstruction() return pre-escaped values.
     *
     * @param $url
     * @param $location
     * @return string
     */
    protected function finalizeFrontendAssetUrl($path, $location) {
        $sec = $this->capacities->get('security');

        $assets_config = $this
            ->processManager
            ->getConfig('config')['frontend-assets'];

        $base_url = $this->processManager->getInstruction('base-url');

        $path_to_app_assets = $this
            ->processManager
            ->getInstruction('url-path-to-app-assets');

        $path_to_theme_assets = $this
            ->processManager
            ->getInstruction('url-path-to-theme-assets');

        $cache_bust_str = $assets_config['cache-bust-str'];

        // Finalize asset URL.

        if ($location == 'app') {
            $url = $base_url
                . $path_to_app_assets
                . '/'
                . $sec->escapeValue($path, 'path_with_file');

        } elseif ($location == 'theme') {
            $url = $base_url
                . $path_to_theme_assets
                . '/'
                . $sec->escapeValue($path, 'path_with_file');
        }

        $url .= '?v=' . $sec->escapeValue($cache_bust_str, 'cache_bust_str');

        return $url;
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
