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
        $apsSetup = $this
            ->processManager->getConfig('apsSetup');

        $tools = $this->capacities->get('tools');
        $asset_management = $this->capacities->get('asset-management');

        $page_payload = $this
            ->capacities
            ->get('content-provider')
            ->getContent();

        if (empty($resource_manifest['has-own-layout'])) {
            $page_payload = $tools->render(
                'layouts/page-level',
                [
                    'wrapper_extra_classes' => 'fallback-page-level',
                    'page_level_content' => "<div class=squeeze>$page_payload</div>"
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
            'stylesheets'       => $asset_management->provideStylesheets(),
            'scripts_in_head'   => $asset_management->provideScripts('head'),
            'body_classes'      => $this->calculateBodyClasses(),
            'svg_sprites'       => $asset_management->inlineSvgSprites(),
            'body_content'      => $body_content,
            'scripts_in_body'   => $asset_management->provideScripts('body'),
        ];

        $this->documentHeadAdditions($document_variables);

        $document = $tools->render('document', $document_variables);

        $sys_notifications = $this->dumpSystemNotifications();

        if (!empty($sys_notifications)) {
            $prepared_sys_notifications = $tools->render('layouts/page-level', [
                'page_level_content' => $sys_notifications
            ]);
            $document = preg_replace('/<!--n10n-->/', $prepared_sys_notifications, $document, 1);
        }

        return $document;
    }


    /**
     * @param $document_variables
     */
    protected function documentHeadAdditions(&$document_variables)
    {
        $livereload = $this->processManager->getConfig('config')['enable-livereload'];

        if (!empty($livereload) && empty(BUILDING_STATIC_PAGE)) {
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
     * Print the accumulated system notifications.
     *
     * NOTE: care was taken to print the highest severity first, then to print
     * the rest in reverse severity order.
     */
    public function dumpSystemNotifications()
    {
        $notifications = $this->processManager->getSystemNotifications();

        if (empty($notifications)) {
            return '';
        }

        $icon_map = $this->processManager->getSystemNotificationSeverityLevels();
        $severity_levels = array_reverse(array_keys($icon_map));

        $output = '';

        foreach ($severity_levels as $level) {
            if (array_key_exists($level, $notifications)) {
                if (count($notifications[$level]) > 1) {
                    $cluster = '<ul>';
                    foreach ($notifications[$level] as $message) {
                        $cluster .= "<li>$message</li>";
                    }
                    $cluster .= '</ul>';
                }
                else {
                    $cluster = '<div>' . $notifications[$level][0] . '</div>';
                }
                $output .= $this->capacities->get('tools')->render('patterns/texts/textblock-common', [
                    'wrapper_extra_classes' => "notification notification--$level",
                    'icon_id'               => $icon_map[$level],
                    'textblock_content'     => $cluster
                ]);
            }
        }

        return '<div class="system-notifications">' . $output . '</div>';
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

            if (empty($page_data['menu'])) {
                continue;
            }

            // We were called during a dynamic php page response.
            if (empty(BUILDING_STATIC_PAGE)) {
                $url = $this
                    ->processManager
                    ->getInstruction('base-url')
                    . $sec->escapeValue($path, 'uri_path');
            }
            // We were called while generating a static snapshot.
            else {
                // Omitting the `html-filename` key from the manifest entry is
                // an implicit instruction about not to put the page into the
                // static snapshot.
                if (!empty($page_data['html-filename'])) {
                    $url = $sec
                        ->escapeValue($page_data['html-filename'], 'file-name')
                        . '.html';
                }
                else {
                    // Skip this page then; move on to the next entry.
                    continue;
                }
            }

            if (empty($skip_page)) {
                if (!empty($page_data['menu']['starts-topic'])) {
                    $app_menu_items[] = [
                        'item_type' => 'topic-title',
                        'text'      => $sec->escapeValue($page_data['menu']['starts-topic']),
                    ];
                }

                $app_menu_items[] = [
                    'item_type' => 'link',
                    'url'       => $url,
                    'text'      => $sec->escapeValue($page_data['menu']['link-text']),
                ];
            }
        }
        unset($path, $page_data);

        return $this
            ->capacities
            ->get('tools')
            ->render('app-infra/app-menu', compact('app_menu_items'), 'php');
    }
}
