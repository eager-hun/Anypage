<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class ProcessManager
 *
 * Responsible for carrying around and exposing all information that business
 * logic implementors need to know about to do their job.
 *
 * This is also the place for all information that is mutable; Information in
 * here can be updated as the script progresses.
 */
class ProcessManager
{
    public $request;
    public $response;
    public $session;

    protected $config = [];
    protected $instructions = [];
    protected $systemNotifications = [];

    protected $baseUrlHasBeenSet = false;

    public function __construct(
        Request $request,
        Response $response,
        Session $session
    )
    {
        $this->request  = $request;
        $this->response = $response;
        $this->session  = $session;

        $this->setUpConfigs();
        $this->setUpResourceLocators();
        $this->setUpHttpStuff();

        $this->session->start();
    }

    /**
     * Add config.
     *
     * @param $key
     * @param $value
     */
    public function addConfig($key, $value)
    {
        if (! array_key_exists($key, $this->config)) {
            $this->config[$key] = $value;
        } else {
            $msg = 'Trying to override config record in ProcessManager. Not good.';
            $this->sysNotify($msg, 'warning');
        }
    }

    /**
     * Access config.
     *
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function getConfig($key)
    {
        if (! array_key_exists($key, $this->config)) {
            $msg = 'Could not find requested item in config.';
            $this->sysNotify($msg, 'warning');

            return null;
        }

        return $this->config[$key];
    }

    /**
     * Store an instruction.
     *
     * @param $key
     * @param $val
     * @param bool $override
     */
    public function setInstruction($key, $val, $override = false)
    {
        if (!array_key_exists($key, $this->instructions) || $override) {
            $this->instructions[$key] = $val;
        } elseif (array_key_exists($key, $this->instructions) && !$override) {
            $msg = 'Trying to override ProcessManager instruction while did not ask permission to.';
            $this->sysNotify($msg, 'warning');
        }
    }

    /**
     * Look up an instruction.
     *
     * @param $key
     * @return mixed
     */
    public function getInstruction($key)
    {
        if (array_key_exists($key, $this->instructions)) {
            return $this->instructions[$key];
        } else {
            $msg = "No such key as $key found in ProcessManager's instructions.";
            $this->sysNotify($msg, 'warning');

            return null;
        }
    }

    /**
     * Helper for the constructor: configs.
     */
    private function setUpConfigs()
    {
        $this->addConfig(
            'config',
            require(CONFIGS . '/config.php')
        );

        $theme_configs = require(CONFIGS . '/config-themes.php');
        $active_theme = $this->getConfig('config')['env']['theme-dir-name'];
        $this->addConfig(
            'themeConfig',
            $theme_configs[$active_theme]
        );

        $this->addConfig(
            'apsSetup',
            require(CONFIGS . '/aps-setup.php')
        );

        $routes_config = require(CONFIGS . '/routes.php');
        $routes_updated = array_merge(
            $routes_config,
            $this->systemPageManifests['everpresent']
        );

        $this->addConfig(
            'routes',
            $routes_updated
        );
    }

    /**
     * Helper for the constructor: resource locators.
     */
    private function setUpResourceLocators()
    {
        $env_config = $this->getConfig('config')['env'];

        $fragment_app_assets = $env_config['path-fragment-to-app-assets'];

        $this->setInstruction(
            'path-fragment-to-app-assets',
            $fragment_app_assets
        );

        $fragment_theme = $env_config['path-fragment-to-themes']
            . '/'
            . $env_config['theme-dir-name'];

        $this->setInstruction(
            'path-fragment-to-theme',
            $fragment_theme
        );
    }

    /**
     * Helper for the constructor: HTTP stuff.
     */
    private function setUpHttpStuff()
    {
        // Methods in the app might update this response code.
        $this->setInstruction('http-response-code-suggestion', 200);

        $this->setInstruction(
            'http-protocol',
            $this->getConfig('config')['env']['http-protocol']
        );
        $this->setInstruction(
            'http-protocol-v',
            $this->getConfig('config')['env']['http-protocol-v']
        );
    }

    /**
     * System page manifests.
     */
    public $systemPageManifests = [
        'everpresent' => [
            'list-generated' => [
                'resource-id'       => 'list_generated',
                'resource-type'     => 'system_page',
                'menu'              => [
                    'starts-topic'  => 'Generator',
                    'link-text' => 'List static snapshots',
                ],
            ],
            'generator' => [
                'resource-id'       => 'generator',
                'resource-type'     => 'system_page',
                'menu'              => [
                    'link-text'     => 'Generate static snapshot',
                ],
            ],
        ],
        'on_demand' => [
            '404' => [
                'resource-id'       => '404',
                'resource-type'     => 'system_page'
            ],
        ]
    ];

    protected $systemNotificationSeverityLevels = [
        'info'      => 'icon-sprite__info-i-in-filled-circle',
        'success'   => 'icon-sprite__checkmark-in-filled-circle',
        'warning'   => 'icon-sprite__exclamation-in-filled-triangle',
        'alert'     => 'icon-sprite__exclamation-in-filled-triangle',
    ];

    /**
     * Add notification to the notification pool.
     *
     * @param $message
     * @param $severity
     */
    public function sysNotify($message, $severity = 'info')
    {
        $severity_levels = array_keys($this->systemNotificationSeverityLevels);

        if (in_array($severity, $severity_levels)) {
            $this->systemNotifications[$severity][] = $message;
        } else {
            $msg = "Please use one of the valid severity levels ('";
            $msg .= implode("', '", $severity_levels);
            $msg .= "') to sys notify.";
            $this->sysNotify($msg, 'warning');
        }
    }

    /**
     * Expose the notifications metadata.
     */
    public function getSystemNotificationSeverityLevels() {
        return $this->systemNotificationSeverityLevels;
    }

    /**
     * Expose the notifications to someone else who can access a renderer.
     */
    public function getSystemNotifications() {
        return $this->systemNotifications;
    }

    /**
     * Base url.
     *
     * NOTE: unsafe.
     * TODO: safeify.
     *
     * NOTE: Static pages are not expected to use baseUrl() for anything.
     *
     * @return string
     */
    protected function baseUrl()
    {
        $working_dir = $this->getConfig('config')['env']['web-working-dir'];

        $protocol = $this->getConfig('config')['env']['http-protocol'];
        $host = $this->request->server->get('HTTP_HOST');

        if (empty($working_dir)) {
            $output = $protocol . '://' . $host . '/';
        }
        else {
            $output = $protocol . '://' . $host . '/' . $working_dir . '/';
        }

        return $output;
    }

    /**
     * Set application-wide base-url, after necessary info had been obtained.
     */
    public function setBaseUrl() {
        if (!$this->baseUrlHasBeenSet) {
            $this->setInstruction('base-url', $this->baseUrl());
            $this->baseUrlHasBeenSet = true;
        }
        else {
            $this->sysNotify(
                'baseUrl has already been set!',
                'warning'
            );
        }
    }


    /**
     * Info about page templates.
     *
     * @var array
     */
    protected $templateInfo = [
        'templates' => [
            'page-template'         => 'page/page--default',
            'page-header-template'  => 'page/page-header/page-header',
            'page-footer-template'  => 'page/page-footer/page-footer'
        ],
        'document-classes' => [],
        'body-classes' => [],
    ];

    public function updateTemplateAssignment($key, $val)
    {
        $this->templateInfo['templates'][$key] = $val;
    }

    public function addBodyClass($classname)
    {
        $this->templateInfo['body-classes'][] = $classname;
    }

    public function addDocumentClass($classname)
    {
        $this->templateInfo['document-classes'][] = $classname;
    }

    public function getTemplateInfo()
    {
        return $this->templateInfo;
    }
}
