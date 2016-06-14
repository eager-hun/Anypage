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

  private $env = [
    'http_protocol' => 'http',
    // No leading or trailing slashes.
    // Provide an empty string if the index.php is located in the public root.
    'working_dir' => 'anypage',
  ];

  private $app = [
    /**
     * Reserved paths.
     *
     * The array value is the watched path fragment, and the array key will
     * become the task id for the request.
     */
    'reserved_paths' => [
      'generate' => 'generate',
    ],
  ];

  private $cache_bust_str = '20160531-1';

  /**
   * Stylesheets to be included with the document.
   *
   * The array keys should contain either 'internal' or 'external' substrings.
   *
   * Any one that contains 'internal' will have the base_url() prepended to it
   * automatically.
   *
   * The numbers in the array keys provide just uniqueness (to prevent
   * overwriting). The order of the asset inclusion on the page is the order of
   * the declaration here (I assume, as long as the array key is a string).
   */
  private $stylesheets = [
    'internal1' => 'engineroom/app-assets/app-ui.css',
    'internal2' => 'frontend-setup/build/css/style-bundle-foundation.css',
    'internal3' => 'frontend-setup/build/css/style-bundle-custom.css',
    //'internal2' => 'theme-being-worked-on/**/foo.css',
    //'internal3' => 'theme-being-worked-on/**/bar.css',
  ];

  /**
   * Javascript files to be included with the document.
   *
   * The array keys should contain either 'internal' or 'external' substrings.
   *
   * Any one that contains 'internal' will have the base_url() prepended to it
   * automatically.
   *
   * The numbers in the array keys provide just uniqueness (to prevent
   * overwriting). The order of the asset inclusion on the page is the order of
   * the declaration here (I assume, as long as the array key is a string).
   */
  private $scripts = [
    'head' => [
      'internal1' => '',
      'external1' => '',
    ],
    'body' => [
      'internal1' => 'engineroom/app-assets/app-ui.js',
      'internal2' => 'frontend-setup/build/js/libs.js',
      'internal3' => 'frontend-setup/build/js/foundation.js',
      'internal4' => 'frontend-setup/build/js/custom.js',
      //'internal2' => 'theme-being-worked-on/**/foo.js',
      //'internal3' => 'theme-being-worked-on/**/bar.js',
    ],
  ];
}


