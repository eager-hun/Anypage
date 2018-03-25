<?php

/**
 * Class Security
 *
 * Responsible for providing methods for filtering incoming data and escaping
 * outbound data.
 */
class Security
{

    protected $processManager;
    protected $config;
    public $arrayHoldingHtmlAttributes;

    public function __construct(
        ProcessManager $processManager
    )
    {
        $this->processManager = $processManager;
        $this->config = $processManager->getConfig('config');
        $this->arrayHoldingHtmlAttributes = $this
            ->collectArrayHoldingHtmlAttributes();
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
        switch ($from)
        {
            case 'foo':
                // TODO
                return $input;
            default:
                // TODO
                return $input;
        }
    }


    /**
     * NOTE: unimplemented yet therefore unsafe!
     *
     * @param mixed $value
     * @param string $use_as
     * @return mixed
     */
    public function escapeValue($value, $use_as = 'display')
    {
        switch ($use_as)
        {
            case 'href':
                // TODO
                return $value;
            case 'cache_bust_str':
                // TODO
                return $value;
            case 'uri_path':
                // TODO
                return $value;
            case 'dir-name':
                // TODO
                return $value;
            case 'file-name':
                // TODO
                return $value;
            case 'path_with_file':
                // TODO
                return $value;
            default:
                // Warning about typos or wrong usage.
                if (!empty($use_as) && $use_as !== 'display') {
                    $this->processManager->sysNotify(
                        'Alert: unrecognized escapeValue() argument!',
                        'alert'
                    );
                }
                // If no argument was supplied, or it was 'display'.
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }


    /**
     * Validates a string.
     *
     * @param string $string
     * @param string $as
     * @return bool
     */
    public function stringValidAs($string, $as)
    {
        if ($as == 'new-dir-name') {
            $allowed_chars = '#[-_a-z0-9]#';
            $non_valid_parts = preg_replace($allowed_chars, '', $string);
            return empty(strlen($non_valid_parts));
        }
        else {
            $this->processManager->sysNotify(
                'Alert: unrecognized argument for stringValidAs()!',
                'alert'
            );
            return FALSE;
        }
    }


    /**
     * HTML attribute whitelist.
     */
    public $html_attribute_whitelist = [
        'id',
        'class',
        'href',
        'name',
        'value',
        'type',
        'placeholder',
        'required',
        'disabled',
        'readonly',
        'checked',
        'data-foo',
        'data-bar',
        'data-foo-array',
        'data-bar-array',
    ];


    /**
     * Determines which HTML attributes are handled as arrays.
     *
     * @return array
     */
    protected function collectArrayHoldingHtmlAttributes() {
        $default_array_holding_attribs = [
            'class' => [
                'separator' => ' ',
            ],
        ];

        $custom_array_holding_attribs = $this
            ->config['code']['html-attribute-values-handled-as-array'];

        // TODO:
        // Maybe at this point check whether the custom definitions interfere
        // with the predefined defaults' values.

        return array_merge_recursive(
            $custom_array_holding_attribs,
            $default_array_holding_attribs
        );
    }


    /**
     * Tells whether an attribute is meant to hold its value as an array.
     */
    public function isArrayHoldingHtmlAttribute($attribute_name) {
        return in_array($attribute_name, array_keys($this->arrayHoldingHtmlAttributes));
    }
}
