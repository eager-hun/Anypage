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
      'path'                 => '',
      'filename_for_content' => 'content-for-home',
      'menu_link_label'      => 'Home',
    ],
    'components_list_page' => [
      'path'                 => 'components-list',
      'filename_for_content' => 'content-for-components-list',
      'menu_link_label'      => 'Components list',
    ],
    'sample_page' => [
      'path'                 => 'sample-page',
      'filename_for_content' => 'content-for-sample-page',
      'menu_link_label'      => 'Sample page',
    ],
  ];
}

