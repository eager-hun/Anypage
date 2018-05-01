<?php

class Navigation
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
     * Provide rendered app menu.
     *
     * @return string
     */
    public function provideAppMenu() {
        $sec = $this->capacities->get('security');
        $base_url = $this->processManager->getInstruction('base-url');
        $pagelist = $this->processManager->getConfig('routes');
        $current_page_id = $this->processManager
            ->getInstruction('resource-id');
        $nice_urls = $this->config['app']['nice-urls'];

        // ---------------------------------------------------------------------
        // Generate app menu items.

        $app_menu_items = [];

        foreach ($pagelist as $path => $page_manifest) {

            // The page definition array did not contain a 'menu' key, meaning
            // that this page does not want to be in the menu.
            if (empty($page_manifest['menu'])) {
                continue;
            }

            // We were called during a dynamic php page response.
            if (empty(BUILDING_STATIC_PAGE)) {
                if ($nice_urls) {
                    $url = $base_url . $sec->escapeValue($path, 'uri_path');
                }
                else {
                    $url = $base_url . 'index.php?path=' . $sec->escapeValue($path, 'uri_path');
                }
            }
            // We were called while generating a static snapshot.
            else {
                // Omitting the `html-filename` key from the manifest entry is
                // an implicit instruction about not to put the page into the
                // static snapshot.
                if (!empty($page_manifest['html-filename'])) {
                    $url = $sec
                            ->escapeValue($page_manifest['html-filename'], 'file-name')
                        . '.html';
                }
                else {
                    // Skip this page then; move on to the next entry.
                    continue;
                }
            }

            if (!empty($page_manifest['menu']['starts-topic'])) {
                $app_menu_items[] = [
                    'item_type' => 'topic-title',
                    'text'      => $sec->escapeValue($page_manifest['menu']['starts-topic']),
                ];
            }

            $link_extra_classes = '';
            if (array_key_exists('resource-id', $page_manifest)
                && $page_manifest['resource-id'] === $current_page_id) {
                $link_extra_classes .= ' is-active';
            }

            $app_menu_items[] = [
                'item_type'             => 'link',
                'url'                   => $url,
                'text'                  => $sec->escapeValue($page_manifest['menu']['link-text']),
                'link_extra_classes'    => $link_extra_classes
            ];
        }
        unset($path, $page_manifest);

        return $this
            ->capacities
            ->get('tools')
            ->render('app-infra/app-menu', compact('app_menu_items'), 'php');
    }
}
