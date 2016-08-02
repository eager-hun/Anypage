<?php

class ContentProvider {
  private $processInfo;
  private $apsSetup;
  private $apsHelper;

  public function __construct(
    ProcessInfo $processInfo,
    ApsSetup $apsSetup,
    ApsHelper $apsHelper
  ) {
    $this->processInfo = $processInfo;
    $this->apsSetup    = $apsSetup;
    $this->apsHelper   = $apsHelper;
  }

  public function renderContent($page_id) {
    if ($page_id == 'app_404') {
      $output = '<h1 class="page__title">404</h1><p>This content was not found.</p>';
    }
    else {
      if ($this->processInfo->get('task_type') == 'generator-ui') {
        $content_prescription_file = APP_SCRIPTS . '/generator-ui.php';
      }
      else {
        $content_prescription_file = APS_DEFINITIONS
          . '/page-prescriptions/'
          . $page_id
          . '.prescription.php';
      }

      if (file_exists($content_prescription_file)) {
        // Making helper stuffs available for page prescriptions.
        $apsHelper  = $this->apsHelper;

        // Bring in page's content.
        ob_start();
        include($content_prescription_file);
        $output = ob_get_clean();
      }
      else {
        // TODO: error handling?
        echo 'Error: content prescription was not found.';
      }
    }

    if (empty($this->apsSetup->get('pages')[$page_id]['has_own_layout'])) {
      $output = $this->apsHelper->page_level_start()
        . $this->apsHelper->container_start()
        . $output
        . $this->apsHelper->container_end()
        . $this->apsHelper->page_level_end();
    }

    return $output;
  }
}

