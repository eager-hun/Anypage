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
    protected $config;
    protected $apsSetup;

    public function __construct(
        ProcessManager $processManager,
        Capacities $capacities
    )
    {
        $this->processManager = $processManager;
        $this->capacities = $capacities;

        $this->config = $this->processManager->getConfig('config');
        $this->apsSetup = $this->processManager->getConfig('apsSetup');
    }


    /**
     * @return string
     */
    public function getDocument()
    {
        // Fetching the page's payload. Make sure it's the first thing, as it
        // needs a chance to update some of the intel that we will use later.

        $page_payload = $this
            ->capacities
            ->get('content-provider')
            ->getContent();

        // Preparing tooling and intel.

        $asset_management   = $this->capacities->get('asset-management');
        $tools              = $this->capacities->get('tools');
        $template_info      = $this->processManager->getTemplateInfo();
        $page_template      = $template_info['templates']['page'];

        $this->processManager->addBodyClass(
            'page-template--' . str_replace('/', '__', $page_template)
        );

        // Rendering the <body> tag's content.

        $page_variables = [
            'page_header_template'  => $template_info['templates']['page-header'],
            'page_footer_template'  => $template_info['templates']['page-footer'],
            'document_properties'   => $this->apsSetup['document_properties'],
            'page_payload'          => $page_payload,
        ];

        $body_content = '';
        $body_content .= $tools->render(
            $page_template,
            $page_variables
        );


        // Rendering the <html> tag.

        $document_variables = [
            'document_attributes'   => $this->documentAttributes(),
            'head_title'            => $this->apsSetup['document_properties']['head_title'],
            'head_misc'             => '',
            'stylesheets'           => $asset_management->provideStylesheets(),
            'scripts_in_head'       => $asset_management->provideScripts('head'),
            'body_classes'          => $this->bodyClasses(),
            'svg_sprites'           => $asset_management->inlineSvgSprites(),
            'body_content'          => $body_content,
            'scripts_in_body'       => $asset_management->provideScripts('body'),
        ];

        $this->documentHeadAdditions($document_variables);

        if ($this->config['app']['app-menu']['is-enabled']) {
            $document_variables['app_menu'] = $this
                ->capacities
                ->get('navigation')
                ->provideAppMenu();
        }

        $document = $tools->render('page/document', $document_variables);

        // Injecting system notifications into the rendered document.

        // We had to postpone it until now, so that all the above code had run
        // and had their opportunity to register any system messages; this was
        // the way to catch the latest possible messages before sending the
        // response.

        $sys_notifications = $this->dumpSystemNotifications();

        if (!empty($sys_notifications)) {
            $prepared_sys_notifications = $tools->render('layouts/page-level', [
                'page_level_content' => $sys_notifications
            ]);
            $document = preg_replace(
                '/<!--n10ns-->/',
                $prepared_sys_notifications,
                $document,
                1
            );
        }

        return $document;
    }


    /**
     * @param $document_variables
     *
     * TODO: secure it.
     */
    protected function documentHeadAdditions(&$document_variables)
    {
        if ( ! empty($this->apsSetup['meta_tags'])) {
            foreach ($this->apsSetup['meta_tags'] as $meta_tag_def) {
                $meta_template_vars = [
                    'name'    => array_key_exists('name', $meta_tag_def) ? $meta_tag_def['name'] : NULL,
                    'content' => array_key_exists('content', $meta_tag_def) ? $meta_tag_def['content'] : NULL,
                ];

                $meta_tag = $this->capacities->get('tools')
                    ->render('app-infra/meta-tag', $meta_template_vars, 'php');

                $document_variables['head_misc'] .= PHP_EOL . $meta_tag;
            }
        }

        $livereload = !empty($this->config['enable-livereload']);
        if ( ! empty($livereload) && empty(BUILDING_STATIC_PAGE)) {
            // See http://stackoverflow.com/questions/26069796/gulp-how-to-implement-livereload-without-chromes-livereload-plugin
            $livereload_script =
                '<script src="http://localhost:35729/livereload.js?snipver=1"></script>';

            $document_variables['head_misc'] .= PHP_EOL . $livereload_script;
        }
    }


    /**
     * @return string
     */
    protected function bodyClasses()
    {
        $body_classes = $this->processManager
            ->getTemplateInfo()['body-classes'];

        $app_menu_config = $this->config['app']['app-menu'];
        if ( ! empty($app_menu_config['is-enabled'])) {
            $body_classes[] = 'app-menu-is-enabled';
        }

        return implode(' ', $body_classes);
    }

    /**
     * @return string
     */
    protected function documentAttributes()
    {
        $document_classes = array_merge(
            ['no-js'],
            $this->processManager->getTemplateInfo()['document-classes']
        );

        $attribs = [
            'lang' => $this->apsSetup['document_properties']['html_lang'],
        ];

        if ( ! empty($document_classes)) {
            $attribs['class'] = implode(' ', $document_classes);
        }

        return $this->capacities->get('tools')->renderAttributes($attribs);
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
}
