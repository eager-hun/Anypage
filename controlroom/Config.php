<?php

class Config {

  public function get($property) {
    if (property_exists('Config', $property)) {
      return $this->$property;
    }
    else {
      // TODO: error handling.
      echo 'No such property to get in Config.';
    }
  }

  /**
   * Vars describing app internals.
   *
   * key 'reserved_paths'.
   *   The array value is the watched path fragment, and the array key will
   *   become the task id for the request.
   */
  private $app = [
    'reserved_paths' => [
      'generator-ui' => 'generator-ui',
    ],
  ];

  /**
   * Describing the app's environment and locations.
   * key 'working_dir':
   *   The subdirectory path in which the application's index.php sits inside
   *   the server document root.
   *   Provide an empty string if the index.php is located in the public root.
   *   No leading or trailing slashes.
   *
   * key 'path_to_app_assets':
   *   Used internally by the php script and also for creating URLs.
   *   Don't include "app-assets" itself.
   *   No leading or trailing slashes.
   *
   * key 'path_to_theme':
   *   Path leading to the "build" dir (containing .css & .js for the frontend).
   *   Used internally by the php script and also for creating URLs.
   *   Don't include "build" itself.
   *   No leading or trailing slashes.
   *
   * key 'html_export_dir':
   *   Used both internally in php script and to create URLs. Provide the
   *   location relative to SCRIPT_ROOT.
   *   No leading or trailing slashes.
   *
   * key 'http_protocol':
   *   String used in creating URLs.
   */
  private $env = [
    'working_dir'        => 'Anypage',
    'path_to_app_assets' => 'engineroom',
    'path_to_theme'      => 'frontend-setup',
    'html_export_dir'    => 'styleguide',
    'http_protocol'      => 'http',
  ];

  /**
   * Stylesheets to be included with the document.
   *
   * The array keys should contain either 'theme', 'app', or 'external'
   * substrings.
   *
   * Use 'external' for assets whose url should be left alone, and inserted
   * into the documents as is. Ideal for such things as e.g. 
   * "https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"
   *
   * Use 'theme' for such files that are inside the theme directory; these
   * strings will have the base_url and $this->env['path_to_theme'] prepended
   * to them automatically when needed.
   *
   * Use 'app' for such files are sitting in /engineroom/app-assets.
   *
   * The numbers in the array keys provide just uniqueness (to prevent
   * overwriting). The order of the asset inclusion on the page is the order of
   * the declaration here (I assume, as long as the array key is a string).
   */
  private $stylesheets = [
    'app1'   => 'app-assets/anypage-app.css',
    'theme1' => 'build/css/style-bundle-foundation.css',
    'theme2' => 'build/css/style-bundle-custom.css',
    'theme3' => 'build/css/style-bundle-styleguide.css',
    'theme4' => 'static-assets/css/static.css',
  ];

  /**
   * Javascript files to be included with the document.
   * 
   * Group the file locations into 'head' and 'body' arrays.
   *
   * The file-describing array keys should contain either 'theme', 'app',
   * or 'external' substrings.
   *
   * Use 'external' for assets whose url should be left alone, and inserted
   * into the documents as is. Ideal for such things as e.g. 
   * "https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"
   *
   * Use 'theme' for such files that are inside the theme directory; these
   * strings will have the base_url and $this->env['path_to_theme'] prepended
   * to them automatically when needed.
   *
   * Use 'app' for such files are sitting in /engineroom/app-assets.
   *
   * The numbers in the array keys provide just uniqueness (to prevent
   * overwriting). The order of the asset inclusion on the page is the order of
   * the declaration here (I assume, as long as the array key is a string).
   */
  private $scripts = [
    'head' => [],
    'body' => [
      'app1'   => 'app-assets/anypage-app.js',
      'theme1' => 'build/js/libs.js',
      'theme2' => 'build/js/foundation.js',
      'theme3' => 'build/js/custom.js',
    ],
  ];

  /**
   * Where window.apSettings and window.apAssets js objects should be printed.
   * 
   * Valid values are 'head' or 'body'.
   */
  private $addJsSettingsObjectTo = 'body';

  /**
   * String to use in the '?v=' URL param for .css and .js files.
   */
  private $cache_bust_str = '20160618-1';
}
