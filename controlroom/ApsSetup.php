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
   * PAGE ID AND CONTENT FILE:
   *
   * The array index that you use as page_id will also form the base of the
   * filename where the app will look for the contents of that page.
   *
   * This means you have to create a file for each page you define here,
   * into which you can put the detailed contents of that page.
   *
   * The location where the new file needs to be created is:
   * anypages/aps-definitions/page-prescriptions
   *
   * The pattern for the filename is as follows:
   * [page_id].prescription.php
   *
   * For example, the content for the page with id 'home' is in:
   * anypages/aps-definitions/page-prescriptions/home.prescription.php
   *
   * PATH:
   *
   * Do not use slashes in the path param, as currently it might break
   * references to assets.
   * (IOW, 'foo/bar' might break things, while 'foo-bar' is safe to use.)
   *
   * HTML FILENAME:
   *
   * For "html_filename", don't provide an extension; ".html" will be assumed.
   *
   * HAS OWN LAYOUT:
   *
   * If this value is not set, a default .page__level and .container wrappers
   * will be applied around the pages's content. If you need anything else
   * than these default wrappers, you need to set the value to true, and
   * sort out your own wrappers in the prescription file.
   */
  private $pages = [
    'home' => [
      'path'           => '',
      'html_filename'  => 'index',
      'menu_link_text' => 'Home',
    ],
    'typography_demo' => [
      'path'           => 'typography-demo',
      'html_filename'  => 'typography-demo',
      'menu_link_text' => 'Typography demo',
      'has_own_layout' => TRUE,
    ],
    'grids_demo' => [
      'path'           => 'grids-demo',
      'html_filename'  => 'grids-demo',
      'menu_link_text' => 'Grids demo',
      'has_own_layout' => TRUE,
    ],
    'layouts_demo' => [
      'path'           => 'layouts-demo',
      'html_filename'  => 'layouts-demo',
      'menu_link_text' => 'Layouts demo',
      'has_own_layout' => TRUE,
    ],
    'custom_components' => [
      'path'           => 'custom-components',
      'html_filename'  => 'custom-components',
      'menu_link_text' => 'Custom components',
      'has_own_layout' => TRUE,
    ],
    'sample_page_1' => [
      'path'           => 'sample-page-1',
      'html_filename'  => 'sample-page-1',
      'menu_link_text' => 'Sample page 1',
      'has_own_layout' => TRUE,
    ],
  ];
}

