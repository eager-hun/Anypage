<?php

class Templating {

  private $config;
  private $utils;

  public function __construct(
    Config $config,
    Utils $utils
  ) {
    $this->config = $config;
    $this->utils  = $utils;
  }

  public function locate_template($template_name, $template_source = 'anypages') {
    $src = ($template_source == 'anypages') ? APS_TEMPLATES : APP_TEMPLATES;
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

