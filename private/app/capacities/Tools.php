<?php

use \Michelf\Markdown;

/**
 * Class Tools
 *
 * Responsible for providing a slew of tools for anypage authoring.
 */
class Tools
{

    protected $processManager;
    protected $capacities;
    protected $templatingConfig;
    private   $fillerTexts;

    public function __construct(
        ProcessManager $processManager,
        Capacities $capacities
    )
    {
        $this->processManager = $processManager;
        $this->capacities = $capacities;

        $this->templatingConfig = $this
            ->processManager
            ->getConfig('config')['app']['templating'];

        $this->fillerTexts = include(APS_CONTENTS . '/reusable/filler-texts.php');
    }


    // #########################################################################
    // Templating.

    /**
     * Determine template filename extension.
     */
    protected function determine_template_file_extension($renderer)
    {
        if ($renderer == 'php') {
            $extension = $this
                ->templatingConfig['php-template-file-extension'];
        }
        elseif ($renderer == 'twig') {
            $extension = $this
                ->templatingConfig['twig-template-file-extension'];
        }

        return $extension;
    }

    /**
     * Locate template.
     *
     * @param string $template_name
     * @param string $renderer
     * @return string
     */
    public function locate_template($template_name, $renderer)
    {
        $src = APS_TEMPLATES;

        $extension = $this->determine_template_file_extension($renderer);

        return str_replace('..', '', $src . '/' . $template_name . $extension);
    }

    /**
     * Renders php or twig templates.
     *
     * @param $template_name
     * @param $variables
     * @param string $renderer
     * @return string
     */
    public function render($template_name, $variables = [], $renderer = '')
    {
        $output = '';

        if (empty($renderer)) {
            $renderer = $this->templatingConfig['default-rendering-engine'];
        }

        if ($renderer == 'php') {
            extract($variables);

            $template_file = $this->locate_template($template_name, $renderer);

            if (file_exists($template_file)) {
                ob_start();
                include($template_file);
                $output = ob_get_clean();
            } else {
                // TODO: error handling.
                $output = '[ Missing php template ]';
            }
        }
        elseif ($renderer == 'twig') {
            if (!empty($this->templatingConfig['enable-twig'])) {
                try {
                    $extension = $this
                        ->determine_template_file_extension($renderer);

                    $output = $this->capacities->get('twig')->render(
                        $template_name . $extension,
                        $variables
                    );
                }
                catch (Exception $e) {
                    $output = 'Caught exception: ' . $e->getMessage();
                }
            } else {
                // TODO: error handling.
                echo 'To use the twig rendering engine, enable it in config.';
            }
        } else {
            // TODO: error handling.
            echo 'Invalid templating engine from config.';
        }

        return $output;
    }


    // #########################################################################
    // Retrieving and processing content.

    /**
     * Process string as markdown.
     *
     * @param $text
     *     markdown.
     * @return string
     *     HTML.
     */
    public function markdown($text)
    {
        return Markdown::defaultTransform($text);
    }

    /**
     * Access and process a file's content.
     *
     * @param $file
     * @param $process
     * @return string
     */
    public function importFileContent($file, $process)
    {

        if (!file_exists($file)) {
            // TODO: error handling.
            return 'ERROR in importFileContent(): specified file does not exist.';
        }

        if ($process == 'php') {

            // Exposing the tools' features inside the imported file.
            $tools = $this;
            ob_start();
            include($file);
            return ob_get_clean();

        } elseif ($process == 'md') {

            $text = file_get_contents($file);
            return $this->markdown($text);

        } elseif ($process == 'display-text') {

            $text = file_get_contents($file);
            return $text;

        } else {

            // TODO: error handling.
            return 'ERROR in importFileContent(): did not understand'
                . 'processing instructions.';

        }
    }

    /**
     * A convenient source of prepared, static, non-changing Lorem ipsum.
     *
     * The texts are coming from anypages/contents/reusable/filler-texts.php
     *
     * @param string $group
     *   See arrays' keys in filler-texts.php.
     * @param integer $instance
     *   See arrays' keys in filler-texts.php.
     * @return string
     *   Markdown-processed lorem ipsum.
     */
    public function addFillerText($group, $instance)
    {

        $text = $this->fillerTexts[$group][$instance];
        return $this->markdown($text);

    }
}