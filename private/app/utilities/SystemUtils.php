<?php

/**
 * Class SystemUtils
 *
 * All sorts of deeply infrastructure-related methods.
 */
class SystemUtils
{

    protected $processManager;
    protected $capacities;

    public function __construct(
        $processManager,
        $capacities
    )
    {
        $this->processManager = $processManager;
        $this->capacities = $capacities;
    }

    /**
     * Base url.
     *
     * NOTE: unsafe.
     * TODO: safeify.
     *
     * @return string
     */
    public function base_url()
    {
        $protocol = $this->processManager->getConfig('config')['env']['http-protocol'];
        $host = $this->processManager->request->server->get('HTTP_HOST');
        $working_dir = $this->processManager->getConfig('config')['env']['working-dir'];

        return $protocol . '://' . $host . '/' . $working_dir . '/';
    }
}
