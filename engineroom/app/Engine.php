<?php

Class Engine {

  private $config;
  private $utils;

  public function __construct(
    Config $config,
    Utils $utils
  ) {
    $this->config = $config;
    $this->utils  = $utils;
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
            $val = $this->utils->base_url() . $val;
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
            $val = $this->utils->base_url() . $val;
          }
          $output .= self::renderScriptTag($val);
        }
      }
      unset($key, $val);
    }

    return $output;
  }
}




