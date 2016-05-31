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
   *
   * For "filename_for_content" provide a filename from the
   * anypages/aps-definitions/page-prescriptions/ directory, whithout its
   * extension (".php" will be assumed).
   */
  private $pages = [
    'home' => [
      'path' => '',
      'filename_for_content' => 'content_for_home',
    ],
    'foo_page' => [
      'path' => 'foo',
      'filename_for_content' => 'content_for_foo',
    ],
    'bar_page' => [
      'path' => 'bar',
      'filename_for_content' => 'content_for_bar',
    ],
  ];
}

