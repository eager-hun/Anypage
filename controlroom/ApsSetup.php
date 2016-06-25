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
   * You can imitate a directory structure in the 'path' parameter, e.g.
   * 'demos/typography-demo'. This imitated directory structure will however
   * not be applied when exporting to static .html. The .html files will
   * be just placed flatly into the same directory.
   *
   * HTML FILENAME:
   *
   * For "html_filename", don't provide an extension; ".html" will be assumed.
   */
  private $pages = [
    'home' => [
      'path'                 => '',
      'html_filename'        => 'index',
      'menu_link_text'       => 'Home',
    ],
    'typography_demo' => [
      'path'                 => 'demos/typography-demo',
      'html_filename'        => 'typography-demo',
      'menu_link_text'       => 'Typography demo',
    ],
    'grids_demo' => [
      'path'                 => 'demos/grids-demo',
      'html_filename'        => 'grids-demo',
      'menu_link_text'       => 'Grids demo',
    ],
    'layouts_demo' => [
      'path'                 => 'demos/layouts-demo',
      'html_filename'        => 'layouts-demo',
      'menu_link_text'       => 'Layouts demo',
    ],
    'components_demo' => [
      'path'                 => 'demos/components-demo',
      'html_filename'        => 'components-demo',
      'menu_link_text'       => 'Components demo',
    ],
  ];
}

