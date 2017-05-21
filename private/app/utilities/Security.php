<?php

/**
 * Class Security
 *
 * Responsible for providing methods for filtering incoming data and escaping
 * outbound data.
 */
class Security {

    protected $processManager;

    public function __construct(
        $processManager
    )
    {
        $this->processManager = $processManager;
    }

    /**
     * NOTE: unimplemented yet therefore unsafe!
     *
     * @param $input
     * @param $from
     * @return mixed
     */
    public function distrustInput($input, $from)
    {
        // TODO.
        return $input;
    }

    /**
     * NOTE: unimplemented yet therefore unsafe!
     *
     * @param $string
     * @param $use_as
     * @return mixed
     */
    public function escapeValue($string, $use_as)
    {
        // TODO.
        return $string;
    }
}
