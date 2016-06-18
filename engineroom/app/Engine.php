<?php

use Symfony\Component\HttpFoundation\Response;

Class Engine {

  private $config;
  private $apsSetup;
  private $processInfo;

  public function __construct(
    Config $config,
    ApsSetup $apsSetup,
    ProcessInfo $processInfo
  ) {
    $this->config   = $config;
    $this->apsSetup = $apsSetup;
    $this->processInfo = $processInfo;
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
          $output .= $this->renderStylesheetLink($val);
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

    $building_static_file = $this->processInfo->get('building_static_file');

    $output = '';

    if ($this->config->get('addJsSettingsObjectTo') == $location) {
      $output .= $this->provideJsSettingsObjects();
    }

    $cluster = $this->config->get('scripts')[$location];

    if (!empty($cluster)) {
      foreach ($cluster as $key => $val) {
        if (!empty($val)) {
          if (strpos($key, 'internal') !== FALSE) {
            $val = apputils_base_url() . $val;
          }
          $output .= $this->renderScriptTag($val);
        }
      }
      unset($key, $val);
    }

    return $output;
  }

  private function provideJsSettingsObjects() {
    $building_static_file = $this->processInfo->get('building_static_file');

    $settings_items = array();

    if ($this->processInfo->get('task_type') == 'generator-ui'
        && empty($building_static_file)) {
      $base_url = apputils_base_url();
      $pagelist = $this->apsSetup->get('pages');

      $page_urls = [];
      foreach ($pagelist as $page_data) {
        $page_urls[] = $base_url
          . $page_data['path'];
      }
      $settings_items['pageUrlList'] = $page_urls;
    }

    $settings = json_encode($settings_items, JSON_FORCE_OBJECT);
    $script =<<<EOT
<script>
  window.apSettings = {$settings};
  window.apAssets = {};
</script>

EOT;
    return $script;
  }

  public function provideAppMenu() {
    $building_static_file = $this->processInfo->get('building_static_file');

    $pagelist = $this->apsSetup->get('pages');

    if (empty($building_static_file)) {
      // If this page does not end up as a static .html file, then we add a few
      // extra links to the menu.
      $pagelist['styleguide'] = [
        'path'            => 'styleguide',
        'menu_link_label' => 'Static exports',
      ];
      $pagelist['generate'] = [
        'path'            => 'generator-ui',
        'menu_link_label' => 'Static HTML generator ...',
      ];
    }

    $menu_items = '';
    foreach ($pagelist as $page_data) {
      if (empty($building_static_file)) {
        $url = apputils_base_url() . $page_data['path'];
      }
      else {
        $url = $page_data['html_filename'] . '.html';
      }
      $menu_items .= '<li>'
        . '<a href="'
        . $url
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

  public function respond($Request, $Response, $ApsSetup, $ProcessInfo, $document) {
    // Save page as HTML.
    if (!empty($ProcessInfo->get('building_static_file'))) {
      $error = FALSE;

      $destination_subdir = $Request->query->get('dir');

      if (empty($destination_subdir)) {
        $error = 'No destination subdirectory was specified; aborting.';
      }

      if (empty($error)) {
        if (empty(apputils_validate_string_as($destination_subdir, 'dirname'))) {
          $error = 'The provided destination subdirectory name was not valid; aborting.';
        }
      }

      if (empty($error)) {
        // Create subdir.
        $static_styleguide_dir_name = 'styleguide';
        $new_dir_name = SCRIPT_ROOT . '/' . $static_styleguide_dir_name . '/' . $destination_subdir;

        if (!file_exists($new_dir_name)) {
          if (!mkdir($new_dir_name)) {
            $error = 'The target subdirectory could not be created.';
          }
        }
        else {
          // Well, this currently lets only the first page to be saved; as the
          // requests for the subsequent pages come in, they would fail as
          // this dir will already exist.
          // TODO: make this check possible by using an extra indicator in
          // session?
          // $error = 'The specified target directory already exists; aborting.';
        }
      }

      if (empty($error)) {
        // Save page as HTML.
        $pages = $ApsSetup->get('pages');
        $filename = $pages[$ProcessInfo->get('page_id')]['html_filename'] . '.html';
        $file = SCRIPT_ROOT
          . '/'
          . $static_styleguide_dir_name
          . '/'
          . $destination_subdir
          . '/'
          . $filename;

        if (file_put_contents($file, $document) !== FALSE) {
          $message = 'Saved page of id: ' . $ProcessInfo->get('page_id') . ' to ' . $file;
        }
        else {
          $error = 'Failed to save page of id: ' . $ProcessInfo->get('page_id');
        }
      }

      if (empty($error)) {
        $Response->setContent($message);
        $Response->setStatusCode(Response::HTTP_OK);
      }
      else {
        $Response->setContent($error);
        $Response->setStatusCode(Response::HTTP_OK);
      }
    }
    // Send back page.
    else {
      $Response->setContent($document);
      $Response->setStatusCode(Response::HTTP_OK);
    }
  }
}

