<?php

class Templating
{

    protected $processManager;
    protected $capacities;
    protected $templatingConfig;

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
    }


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
        $src = TEMPLATES;

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
                $message = 'ERROR: missing php template: '
                    . htmlspecialchars(
                        $template_name,
                        ENT_QUOTES,
                        "utf-8"
                    );
                $output = $message;
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
                    // So, when the renderer experiences a problem, it might be
                    // wiser not to make it try using itself recursively to
                    // render the error message...
                    $output = '<div class="notification notification--alert">'
                        . 'Caught exception: ' . $e->getMessage() . '</div>';
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
};
