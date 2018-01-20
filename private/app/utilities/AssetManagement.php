<?php

class AssetManagement
{

    protected $processManager;
    protected $capacities;
    protected $assetsConfig;

    public function __construct(
        ProcessManager $processManager,
        Capacities $capacities
    )
    {
        $this->processManager = $processManager;
        $this->capacities = $capacities;
        $this->assetsConfig = $this
            ->processManager->getConfig('config')['frontend-assets'];
    }


    /**
     * Provides a series of stylesheet links for the app as one rendered string.
     *
     * @return string
     */
    public function provideStylesheets()
    {
        $stylesheets = $this->assetsConfig['stylesheets'];

        $output = '';

        if (!empty($stylesheets)) {
            $output = $this->renderStylesheets($stylesheets);
        }

        return $output;
    }


    /**
     * Render stylesheets.
     *
     * @param $stylesheets
     * @return string
     */
    public function renderStylesheets($stylesheets)
    {
        $output = '';

        foreach ($stylesheets as $entry) {
            if (!empty($entry['ignore'])) {
                continue;
            }

            if (empty($entry['source']) || empty($entry['file'])
                || empty($entry['use_as'])) {
                $msg = 'Missing config values in stylesheet entry definition.';
                $this->processManager->sysNotify($msg, 'warning');
                continue;
            }

            if ( ! in_array($entry['source'], ['app', 'theme'])) {
                $msg = 'renderStylesheets() encountered an invalid source designation.';
                $this->processManager->sysNotify($msg, 'warning');
                continue;
            }

            if ($entry['use_as'] == 'reference') {
                $href = $this->finalizeFrontendAssetUrl($entry['file'], $entry['source']);

                $output .= $this->capacities->get('tools')->render(
                    'app-infra/stylesheet-link',
                    ['href' => $href],
                    'php'
                );
            }
            elseif ($entry['use_as'] == 'inline') {
                // TODO.
                $msg = "Inlining stylesheets is not implemented yet.";
                $this->processManager->sysNotify($msg, 'warning');
                continue;
            }
        }
        unset($entry);

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
        $scripts = $this->assetsConfig['scripts'];

        $output = '';

        if ($this->assetsConfig['add-js-settings-object-to'] == $location) {
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

        foreach ($scripts as $entry) {
            if (!empty($entry['ignore'])) {
                continue;
            }

            if (empty($entry['source']) || empty($entry['file'])) {
                $msg = 'Missing config values in script entry definition.';
                $this->processManager->sysNotify($msg, 'warning');
                continue;
            }

            if ($entry['source'] == 'external') {
                // TODO.
                $msg = "Using scripts from external resources is not implemented yet.";
                $this->processManager->sysNotify($msg, 'warning');
                continue;
            }

            if ($entry['use_as'] == 'reference') {
                // No content for the <script> tag.
                unset($entry['code']);

                $entry['src_value'] =
                    $this->finalizeFrontendAssetUrl(
                        $entry['file'],
                        $entry['source']
                    );

                $output .= $this->renderScriptTag($entry);
            }
            elseif ($entry['use_as'] == 'inline') {
                // TODO.
                $msg = "Inlining scripts is not implemented yet.";
                $this->processManager->sysNotify($msg, 'warning');
                continue;
            }
        }
        unset($entry);

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
        $code       = '';

        if (!empty($script_props['src_value'])) {
            $src_attrib = ' src="' . $script_props['src_value'] . '"';
        }
        elseif (!empty($script_props['code'])) {
            $code = $script_props['code'];
        }

        return $this->capacities->get('tools')->render(
            'app-infra/script-tag',
            [
                'src_attrib'    => $src_attrib,
                'code'          => $code,
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
     * TODO: SECURE!
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

        if ($this->svgSpritesAreDeliveredViaAjax()) {
            $settings_items['svgSprites'] = $this->assetsConfig['svgSprites'];
        }

        if ($resource_id == "generator") {
            $generator = $this->capacities->get('site-generator');
            $settings_items['staticSitePageUrlList'] = $generator->staticSitePageUrlList();

            $snapshot_dirname_prefix = $this->processManager
                ->getConfig('config')['app']['generator']['snapshot-directory-name-prefix'];
            $settings_items['snapshotDirNamePrefix'] = $snapshot_dirname_prefix;
        }

        $settings = json_encode($settings_items, JSON_FORCE_OBJECT);

        $script = "window.apSettings = $settings;";
        $script .= PHP_EOL;
        $script .= 'window.apAssets = {};';

        $scriptTag = $this->renderScriptTag([
            'code'  => $script
        ]);

        return $scriptTag;
    }

    
    /**
     * Are SVG sprites delivered via ajax?
     *
     * Static pages don't use ajax delivery.
     *
     * @return bool
     */
    protected function svgSpritesAreDeliveredViaAjax()
    {
        return empty(BUILDING_STATIC_PAGE);
    }

    
    /**
     * SVG sprite delivery.
     *
     * @return string
     */
    public function inlineSvgSprites()
    {
        $sprite_refs = $this->assetsConfig['svgSprites'];

        if (empty($sprite_refs)) {
            return '';
        }

        $via_ajax = '';
        $svg = '';

        if (!empty($this->svgSpritesAreDeliveredViaAjax())) {
            $via_ajax = 'data-svg-via-ajax';
        }
        else {
            $tools = $this->capacities->get('tools');

            $access_to_theme = DIRECTOR_DIR
                . DIRECTORY_SEPARATOR
                . $this
                    ->processManager
                    ->getInstruction('path-fragment-to-theme');

            foreach ($sprite_refs as $file_ref) {
                $svg .= $tools->importFileContent(
                    $access_to_theme . DIRECTORY_SEPARATOR . $file_ref,
                    'plain'
                );
            }
            unset($file_ref);
        }

        $output = <<<EOT
            <div id="svg-sprite-housing" $via_ajax>$svg</div>
EOT;

        return $output;
    }
};
