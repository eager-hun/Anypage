<?php

/**
 * Class DocumentProvider
 *
 * Responsible for delivering a fully assembled/rendered HTML document
 * (the <html> tag).
 */
class DocumentProvider
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
     * @return string
     */
    public function getDocument()
    {
        $document_body_content = '';

        $document_body_content .= $this
            ->capacities
            ->get('content-provider')
            ->getContent();

        $document_body_content .= $this->provideAppMenu();

        $template_variables = [
            'document_body' => $document_body_content,
        ];

        return $this
            ->capacities
            ->get('tools')
            ->render('document', $template_variables);
    }

    protected function documentHeadAdditions(&$variables_for_document)
    {

    }

    public function renderStylesheetLink($href)
    {

    }

    public function renderScriptTag($src, $opts = [])
    {

    }

    private function frontendAssetsHelper($assets, $kind, &$output)
    {

    }

    private function provideJsSettingsObjects()
    {

    }

    public function provideStylesheets()
    {

    }

    public function provideScripts($location)
    {

    }

    /**
     * Provide rendered app menu.
     *
     * NOTE: unsafe.
     * TODO: safeify.
     *
     * @return string
     */
    public function provideAppMenu() {
        $pagelist = $this->processManager->getConfig('routes');
        // var_dump($pagelist);

        $menu_items = '';

        foreach ($pagelist as $path => $page_data) {
            // We were called during a dynamic php page response.
            if (! defined('BUILDING_STATIC_FILE') || empty(BUILDING_STATIC_FILE)) {
                $url = $this
                    ->capacities
                    ->get('system-utils')
                    ->base_url() . $path;
            }
            // We were called while generating a static site.
            else {
                // For the static site, include only the anypages in the menu.
                if ($page_data['resource-type'] != 'anypage') {
                    continue;
                }

                $url = $page_data['html-filename'] . '.html';
            }

            $menu_items .= '<li>'
                . '<a href="'
                . $url
                . '" class="app-menu__link">'
                . '<span class="link__text">'
                . $page_data['menu-link-text']
                . '</span>'
                . '</a>'
                . '</li>'
                . PHP_EOL;
        }

        $menu = PHP_EOL
            . '<nav class="app-menu"><ul>'
            . PHP_EOL
            . $menu_items
            . '</ul></nav>';

        return $menu;
    }
}
