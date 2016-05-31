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

    if ($page_id == '404') {
      return 'Not found.';
    }

    $output = 'Content for ' . $page_id;

    // Dummy content.
    $output .= $this->sg_item();
    $output .= $this->sg_item();

    return $output;
  }

  // Building dummy content.

  private function sg_component_sample() {
    $template_name = 'layout-sample';
    $variables = [
      'top'    => 'Content in top',
      'bottom' => 'Content in bottom',
    ];

    return $this->templating->render($template_name, $variables);
  }

  private function sg_item() {
    $template_name = 'sg-item';

    $view_code = 'Code not found.'; // Fallback.
    if (file_exists($this->templating->locate_template('layout-sample'))) {
      $view_code = htmlspecialchars(
        file_get_contents($this->templating->locate_template('layout-sample'))
      );
    }

    $variables = [
      'title'       => 'Sample item title',
      'description' => 'Sample item description.',
      'code'        => 'Code:<br><pre><code>' . $view_code . '</code></pre>',
      'content'     => $this->sg_component_sample($this->templating),
    ];

    return $this->templating->render($template_name, $variables, 'app');
  }
}

