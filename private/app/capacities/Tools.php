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
     * "Proxying" `Templating`'s `render` method in `Tools`.
     *
     * I can imagine there would be better ways to achieve this thing.
     *
     * @param $template_name
     * @param $variables
     * @param string $renderer
     * @return string
     */
    public function render($template_name, $variables = [], $renderer = '')
    {
        return $this
            ->capacities->get('templating')
            ->render($template_name, $variables, $renderer);
    }


    /**
     * "Proxying" `Templating`'s `renderAttributes` method in `Tools`.
     *
     * I can imagine there would be better ways to achieve this thing.
     *
     * @param $attributes
     * @return string
     */
    public function renderAttributes($attributes = [])
    {
        return $this
            ->capacities->get('templating')
            ->renderAttributes($attributes);
    }


    // -------------------------------------------------------------------------
    // Instructions about templating.

    /**
     * @param $template_name
     */
    public function usePageTemplate($template_name)
    {
        $this->processManager->updateTemplateAssignment(
            'page-template',
            $template_name
        );
    }

    /**
     * @param $template_name
     */
    public function usePageHeaderTemplate($template_name)
    {
        $this->processManager->updateTemplateAssignment(
            'page-header-template',
            $template_name
        );
    }

    /**
     * @param $template_name
     */
    public function usePageFooterTemplate($template_name)
    {
        $this->processManager->updateTemplateAssignment(
            'page-footer-template',
            $template_name
        );
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

        if ( ! file_exists($file)) {
            $msg = 'Error in importFileContent(): specified file does not exist.';
            $this->processManager->sysNotify($msg, 'alert');
            return false;
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

        } elseif ($process == 'plain') {

            $text = file_get_contents($file);
            return $text;

        } else {
            $msg = 'ERROR in importFileContent(): did not understand'
                . 'processing instructions.';
            $this->processManager->sysNotify($msg, 'warning');
            return false;
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
    public function addFillerText($group, $instance, $markdown = false)
    {
        $text = $this->fillerTexts[$group][$instance];

        if ($markdown === true) {
            return $this->markdown($text);
        }
        else {
            return $text;
        }
    }


    // #########################################################################
    // Misc.

    public function pathToThemeStaticFiles()
    {
        if (empty(BUILDING_STATIC_PAGE)) {
            $base_url = $this->processManager
                ->getInstruction('base-url');
            $path_to_theme = $this->processManager
                ->getInstruction('path-fragment-to-theme');

            $output = $base_url . $path_to_theme . '/static-assets';
        }
        else {
            $output = 'static-assets';
        }

        return $output;
    }

    protected $uniqueIdIndex = 0;

    /**
     * Ensures an id is unique.
     *
     * @param $base_string
     * @return string
     */
    public function uniqueId($base_string) {
        $this->uniqueIdIndex++;

        return $base_string . '-' . $this->uniqueIdIndex;
    }
}
