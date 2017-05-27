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
        ProcessManager $processManager,
        Capacities $capacities
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
        $resource_manifest = $this
            ->processManager->getInstruction('resource-manifest');
        $apsSetup = $this->processManager->getConfig('apsSetup');

        $tools = $this->capacities->get('tools');

        $page_payload = $this
            ->capacities
            ->get('content-provider')
            ->getContent();

        $page_variables = [
            'page_header_content' => 'This is the page header content.',
            'page_payload' => $page_payload,
            'page_footer_content' => 'This is the page footer content.',
        ];

        $body_content = '';
        $body_content .= $tools->render('page', $page_variables);
        $body_content .= $this->provideAppMenu();

        $document_variables = [
            'html_language' => $apsSetup['defaults']['document_properties']['html_lang'],
            'head_title' => $apsSetup['defaults']['document_properties']['head_title'],
            'body_classes' => $this->calculateBodyClasses(),
            'body_content' => $body_content,
        ];
        return $tools->render('document', $document_variables);
    }

    protected function calculateBodyClasses()
    {
        // TODO.
        return 'body-class';
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
     * @return string
     */
    public function provideAppMenu() {
        $pagelist = $this->processManager->getConfig('routes');
        $sec = $this->capacities->get('security');

        $app_menu_items = [];

        foreach ($pagelist as $path => $page_data) {

            // We were called during a dynamic php page response.
            if (! defined('BUILDING_STATIC_FILE') || empty(BUILDING_STATIC_FILE)) {
                $url = $this
                    ->capacities
                    ->get('system-utils')
                    ->base_url() . $sec->escapeValue($path, 'uri_path');
            } else {
                // We were called while generating a static site.

                // For the static site, include only the anypages in the menu.
                if ($page_data['resource-type'] != 'anypage') {
                    continue;
                }

                $url = $sec
                    ->escapeValue($page_data['html-file_name'], 'filename')
                    . '.html';
            }

            $app_menu_items[] = [
                'url' => $url,
                'text' => $sec->escapeValue($page_data['menu-link-text']),
            ];
        }

        return $this
            ->capacities
            ->get('tools')
            ->render('app-infra/app-menu', compact('app_menu_items'), 'php');
    }
}
