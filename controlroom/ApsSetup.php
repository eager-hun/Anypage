<?php

class ApsSetup {

  public function get($property) {
    if (property_exists('ApsSetup', $property)) {
      return $this->$property;
    }
    else {
      // TODO: error handling.
      echo 'No such property to get in ApsSetup.';
    }
  }

  /**
   * Page definitions.
   */
  private $pages = [
    'home' => [
      'path' => '',
    ],
    'foo_page' => [
      'path' => 'foo',
    ],
    'bar_page' => [
      'path' => 'bar',
    ],
  ];
}

