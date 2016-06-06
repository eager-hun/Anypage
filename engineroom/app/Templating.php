<?php

class Templating {

  private $config;

  public function __construct(Config $config) {
    $this->config = $config;
  }

  public function locate_template($template_name) {
    $src = APS_TEMPLATES;
    return $src . '/' . $template_name . '.template.php';
  }

  public function render($template_name, $variables, $template_source = 'anypages') {

    foreach ($variables as $key => $val) {
      $$key = $val;
    }
    unset($key, $val);

    ob_start();
    include($this->locate_template($template_name, $template_source));
    return ob_get_clean();
  }
}

