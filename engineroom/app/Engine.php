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

  private function frontendAssetsHelper($assets, $kind, &$output) {
    $building_static_file = $this->processInfo->get('building_static_file');

    foreach ($assets as $key => $val) {
      if (strpos($key, 'theme') !== false
        && empty($building_static_file)) {
        $val = apputils_base_url()
          . $this->config->get('env')['path_to_theme']
          . '/'
          . $val;
      }
      elseif (strpos($key, 'app') !== false
        && empty($building_static_file)) {
        $val = apputils_base_url()
          . $this->config->get('env')['path_to_app_assets']
          . '/'
          . $val;
      }

      if (!empty($val)) {
        if ($kind == 'styles') {
          $output .= $this->renderStylesheetLink($val);
        }
        elseif ($kind == 'scripts') {
          $output .= $this->renderScriptTag($val);
        }
      }
    }

    unset($key, $val);
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

  public function provideStylesheets() {
    $output = '';
    $stylesheets = $this->config->get('stylesheets');
    if (!empty($stylesheets)) {
      $this->frontendAssetsHelper($stylesheets, 'styles', $output);
    }
    return $output;
  }

  public function provideScripts($location) {
    if ($location != 'head' && $location != 'body') {
      // TODO: error msg.
      return FALSE;
    }
    $output = '';
    if ($this->config->get('addJsSettingsObjectTo') == $location) {
      $output .= $this->provideJsSettingsObjects();
    }
    $cluster = $this->config->get('scripts')[$location];
    if (!empty($cluster)) {
      $this->frontendAssetsHelper($cluster, 'scripts', $output);
    }
    return $output;
  }

  public function provideAppMenu() {
    $building_static_file = $this->processInfo->get('building_static_file');

    $pagelist = $this->apsSetup->get('pages');

    if (empty($building_static_file)) {
      // If this page does not end up as a static .html file, then we add a few
      // extra links to the menu.
      $pagelist['styleguide'] = [
        'path'            => $this->config->get('env')['html_export_dir'],
        'menu_link_label' => 'Generated static instances',
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

  public function savePageAsHTML($Request, $Response, $ApsSetup, $ProcessInfo, $document) {
    $error = FALSE;

    $destination_subdir = $Request->query->get('dir');

    // Validations.
    if (empty($destination_subdir)) {
      $error = 'No destination subdirectory was specified; aborting.';
    }
    if (empty($error)) {
      if (!apputils_string_valid_as($destination_subdir, 'dirname')) {
        $error = 'The provided destination subdirectory name was not valid; aborting.';
      }
    }

    // Create the subdir for the new styleguide instance.
    if (empty($error)) {
      $static_styleguide_dir_name = $this->config->get('env')['html_export_dir'];
      $new_sg_instance_dirname = SCRIPT_ROOT
        . DIRECTORY_SEPARATOR
        . $static_styleguide_dir_name
        . DIRECTORY_SEPARATOR
        . $destination_subdir;

      if (!file_exists($new_sg_instance_dirname)) {
        if (!mkdir($new_sg_instance_dirname)) {
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

    // Copy over the frontend assets, if they are not there yet.
    // FIXME.
    // Copying directories in shell is just for the sake of the proof of
    // concept.  Directory copying should be done with php, not in shell.
    if (empty($error)) {

      $location_of_original_build = SCRIPT_ROOT
        . DIRECTORY_SEPARATOR
        . $this->config->get('env')['path_to_theme']
        . DIRECTORY_SEPARATOR
        . 'build';
      $build_dir_copy = $new_sg_instance_dirname
        . DIRECTORY_SEPARATOR
        . 'build';

      if (!file_exists($build_dir_copy)) {
        exec('cp -r ' . escapeshellarg($location_of_original_build) . ' ' . escapeshellarg($build_dir_copy));
      }

      $app_assets_original = SCRIPT_ROOT
        . DIRECTORY_SEPARATOR
        . $this->config->get('env')['path_to_app_assets']
        . DIRECTORY_SEPARATOR
        . 'app-assets';
      $app_assets_copy = $new_sg_instance_dirname
        . DIRECTORY_SEPARATOR
        . 'app-assets';

      if (!file_exists($app_assets_copy)) {
        exec('cp -r ' . escapeshellarg($app_assets_original) . ' ' . escapeshellarg($app_assets_copy));
      }
    }

    // Save page as HTML.
    if (empty($error)) {
      $pages = $ApsSetup->get('pages');
      $filename = $pages[$ProcessInfo->get('page_id')]['html_filename'] . '.html';
      $file = SCRIPT_ROOT
        . DIRECTORY_SEPARATOR
        . $static_styleguide_dir_name
        . DIRECTORY_SEPARATOR
        . $destination_subdir
        . DIRECTORY_SEPARATOR
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
}

