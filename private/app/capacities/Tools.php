<?php

/**
 * Class Tools
 *
 * Responsible for providing a slew of tools for anypage authoring.
 */
class Tools
{

    protected $processManager;
    protected $capacities;
    protected $templating_config;

    public function __construct(
        ProcessManager $processManager,
        Capacities $capacities
    )
    {
        $this->processManager = $processManager;
        $this->capacities = $capacities;

        $this->templating_config = $this
            ->processManager
            ->getConfig('config')['app']['templating'];
    }

    /**
     * Determine template filename extension.
     */
    protected function determine_template_file_extension($renderer)
    {
        if ($renderer == 'php') {
            $extension = $this
                ->templating_config['php-template-file-extension'];
        }
        elseif ($renderer == 'twig') {
            $extension = $this
                ->templating_config['twig-template-file-extension'];
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
            $renderer = $this->templating_config['default-rendering-engine'];
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
            if (!empty($this->templating_config['enable-twig'])) {
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
}
