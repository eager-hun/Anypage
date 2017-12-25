<?php

class AssetManagement
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
     * Finalize a frontend asset url.
     *
     * TODO: make processManager->getInstruction() return pre-escaped values.
     *
     * @param $path
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
            ->getInstruction('path-fragment-to-app-assets');

        $path_to_theme = $this
            ->processManager
            ->getInstruction('path-fragment-to-theme');

        $cache_bust_str = $assets_config['cache-bust-str'];

        // Finalize asset URL.

        if ($location == 'app') {
            if (empty(BUILDING_STATIC_PAGE)) {
                $url = $base_url
                    . $path_to_app_assets
                    . '/'
                    . $sec->escapeValue($path, 'path_with_file');
            }
            else {
                $url = 'app-assets/' . $sec->escapeValue($path, 'path_with_file');
            }
        } elseif ($location == 'theme') {
            if (empty(BUILDING_STATIC_PAGE)) {
                $url = $base_url
                    . $path_to_theme
                    . '/'
                    . $sec->escapeValue($path, 'path_with_file');
            }
            else {
                $url = $sec->escapeValue($path, 'path_with_file');
            }
        }

        $url .= '?v=' . $sec->escapeValue($cache_bust_str, 'cache_bust_str');

        return $url;
    }


    /**
     * Provide JS settings object.
     *
     * @return string
     */
    protected function provideJsSettingsObject()
    {
        $settings_items = [];

        $base_url = $this->processManager->getInstruction('base-url');
        $path_to_theme = $this->processManager->getInstruction('path-fragment-to-theme');

        $settings_items['baseUrl'] = $base_url;

        if (empty(BUILDING_STATIC_PAGE)) {
            $settings_items['themeUrl'] = $base_url . $path_to_theme;
        }
        else {
            $settings_items['themeUrl'] = '.';
        }

        $resource_id = $this->processManager->getInstruction('resource-id');

        if ($resource_id == "generator") {
            $generator = $this->capacities->get('site-generator');
            $settings_items['staticSitePageUrlList'] = $generator->staticSitePageUrlList();
        }

        $settings = json_encode($settings_items, JSON_FORCE_OBJECT);

        $script = "window.apSettings = $settings;";
        $script .= PHP_EOL;
        $script .= 'window.apAssets = {};';

        $scriptTag = $this->renderScriptTag([
            'script'  => $script
        ]);

        return $scriptTag;
    }
};
