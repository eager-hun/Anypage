<?php

class ContentProvider {
  private $processInfo;
  private $apsSetup;
  private $templating;

  public function __construct(
    ProcessInfo $processInfo,
    ApsSetup $apsSetup,
    Templating $templating
  ) {
    $this->processInfo = $processInfo;
    $this->apsSetup    = $apsSetup;
    $this->templating  = $templating;
  }

  public function renderContent($page_id) {
    if ($page_id == 'app_404') {
      $output = 'Not found.';
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
        // Let's make the $templating device available for page prescriptions.
        $templating = $this->templating;

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
      $output = aps_page_level_start()
        . aps_container_start()
        . $output
        . aps_container_end()
        . aps_page_level_end();
    }

    return $output;
  }
}

