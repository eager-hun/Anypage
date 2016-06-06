<?php

class ContentProvider {
  private $apsSetup;
  private $templating;

  public function __construct(
    ApsSetup $apsSetup,
    Templating $templating
  ) {
    $this->apsSetup = $apsSetup;
    $this->templating = $templating;
  }

  public function buildContent($page_id) {
    if ($page_id == 'app_404') {
      return 'Not found.';
    }

    $page_definition = $this->apsSetup->get('pages')[$page_id];
    $content_prescription_file = APS_DEFINITIONS
      . '/page-prescriptions/'
      . $page_definition['filename_for_content']
      . '.php';

    if (file_exists($content_prescription_file)) {
      // Pick up shared functions.
      include(APS . '/aps-common-functions.php');
      // Bring in page's content.
      ob_start();
      include($content_prescription_file);
      $output = ob_get_clean();
    }
    else {
      // TODO: error handling?
      echo 'Error: content prescription was not found.';
    }

    return $output;
  }
}

