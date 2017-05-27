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
        ProcessManager $processManager,
        Capacities $capacities
    )
    {
        $this->processManager = $processManager;
        $this->capacities = $capacities;
    }
}
