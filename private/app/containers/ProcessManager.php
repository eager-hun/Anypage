<?php

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

    protected $config = [];
    protected $instructions = [];

    protected $sys_notifications = [];

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;

        $this->addConfig(
            'config',
            require(PRIVATE_ASSETS . '/config/config.php')
        );
        $this->addConfig(
            'apsSetup',
            require(PRIVATE_ASSETS . '/config/apsSetup.php')
        );
        $this->addConfig(
            'routes',
            require(PRIVATE_ASSETS . '/config/routes.php')
        );

        // Methods in the app might update this response code.
        $this->setInstruction('http-response-code', '200');

        // Might get updated in the "orientation" stage.
        $this->setInstruction('building-static-page', false);

        $this->setInstruction(
            'http-protocol',
            $this->getConfig('config')['env']['http-protocol']
        );
        $this->setInstruction(
            'http-protocol-v',
            $this->getConfig('config')['env']['http-protocol-v']
        );

        $this->setInstruction('base-url', $this->baseUrl());

        $this->setInstruction(
            'url-path-to-app-assets',
            'public/app-assets'
        );

        $this->setInstruction(
            'url-path-to-theme-assets',
            'public/themes/' . $this->getConfig('config')['env']['theme-dir-name']
        );
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
     * System page manifests.
     */
    public $systemPageManifests = [
        '404' => [
            'resource-id'       => '404',
            'resource-type'     => 'system_page'
        ],
    ];

    /**
     * Add notification to the notification pool.
     *
     * @param $message
     * @param $severity
     */
    public function sysNotify($message, $severity = 'info')
    {
        $valid_severity_levels = [
            'info',
            'success',
            'warning',
            'alert'
        ];

        if (in_array($severity, $valid_severity_levels)) {
            $this->sys_notifications[$severity][] = $message;
        } else {
            $msg = "Please use one of the valid severity levels ('";
            $msg .= implode("', '", $valid_severity_levels);
            $msg .= "') to sys notify.";
            $this->sysNotify($msg, 'warning');
        }
    }

    /**
     * Print the accumulated notifications.
     */
    public function dumpNotifications()
    {
        if (!empty($this->sys_notifications)) {
            // TODO;
            var_dump($this->sys_notifications);
        }
    }

    /**
     * Base url.
     *
     * NOTE: unsafe.
     * TODO: safeify.
     *
     * @return string
     */
    private function baseUrl()
    {
        $protocol = $this->getConfig('config')['env']['http-protocol'];
        $host = $this->request->server->get('HTTP_HOST');
        $working_dir = $this->getConfig('config')['env']['working-dir'];

        return $protocol . '://' . $host . '/' . $working_dir . '/';
    }
}
