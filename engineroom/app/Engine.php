<?php

Class Engine {

  private $config;
  private $apsSetup;

  public function __construct(
    Config $config,
    ApsSetup $apsSetup
  ) {
    $this->config   = $config;
    $this->apsSetup = $apsSetup;
  }

  public function renderStylesheetLink($href) {
    $cb = $this->config->get('cache_bust_str');

    $output = <<<EOT
<link rel="stylesheet" type="text/css" href="{$href}?v={$cb}">
EOT;

    return $output . PHP_EOL;
  }

  public function renderScriptTag($src, $opts = []) {
    // TODO: $opts.
    $cb = $this->config->get('cache_bust_str');

    $output = <<<EOL
<script src="{$src}?v={$cb}"></script>
EOL;
    return $output . PHP_EOL;
  }

  public function provideStylesheets() {

    $output = '';
    $stylesheets = $this->config->get('stylesheets');

    if (!empty($stylesheets)) {
      foreach ($stylesheets as $key => $val) {
        if (!empty($val)) {
          if (strpos($key, 'internal') !== false) {
            $val = apputils_base_url() . $val;
          }
          $output .= self::renderStylesheetLink($val);
        }
      }
      unset($key, $val);
    }

    return $output;
  }

  public function provideScripts($location) {
    if ($location != 'head' && $location != 'body') {
      // TODO: error msg.
      return FALSE;
    }

    $output = '';
    $cluster = $this->config->get('scripts')[$location];

    if (!empty($cluster)) {
      foreach ($cluster as $key => $val) {
        if (!empty($val)) {
          if (strpos($key, 'internal') !== FALSE) {
            $val = apputils_base_url() . $val;
          }
          $output .= self::renderScriptTag($val);
        }
      }
      unset($key, $val);
    }

    return $output;
  }

  public function provideAppMenu() {
    $pagelist = $this->apsSetup->get('pages');
    // Adding a link for the generator page, which is not part of the
    // page definitions.
    $pagelist['generate'] = [
      'path'            => 'generate',
      'menu_link_label' => 'Generate static HTML',
    ];

    $menu_items = '';
    foreach ($pagelist as $page_data) {
      $menu_items .= '<li>'
        . '<a href="'
        . apputils_base_url() . $page_data['path']
        . '" class="app-menu__link">'
        . $page_data['menu_link_label']
        . '</a>'
        . '</li>'
        . PHP_EOL;
    }

    $menu = '<nav class="app-menu"><ul>'
      . PHP_EOL
      . $menu_items
      . '</ul></nav>';

    return $menu;
  }
}




