<?php

use \Michelf\Markdown;

class Templating {

  private $config;
  private $filler_texts;

  public function __construct(Config $config, $with_filler_texts = FALSE) {
    $this->config = $config;

    if ($with_filler_texts == TRUE) {
      include(APS_CONTENTS . '/reusable/filler-texts.php');
      $this->filler_texts = $aps_filler_texts;
    }
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

  public function add_filler_text($group, $instance) {
    if (!empty($this->filler_texts)) {
      $text = $this->filler_texts[$group][$instance];
      return Markdown::defaultTransform($text);
    }
    else {
      // TODO: error handling.
    }
  }
}

