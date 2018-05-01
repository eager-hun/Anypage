<?php

class HttpException extends Exception
{
    private $statusCodeSuggestion;

    public function __construct($message, $statusCodeSuggestion)
    {
        parent::__construct($message);

        $this->statusCodeSuggestion = $statusCodeSuggestion;
    }

    public function getStatusCodeSuggestion()
    {
        return $this->statusCodeSuggestion;
    }
}
