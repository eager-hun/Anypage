<?php

use \Michelf\Markdown;

class ApsHelper {

  private $config;
  // Let's make twig functionality available whereever ApsHelper is available.
  public $twig;
  private $filler_texts;

  public function __construct(Config $config, $twig) {
    $this->config = $config;
    $this->twig   = $twig;

    include(APS_CONTENTS . '/reusable/filler-texts.php');
    $this->filler_texts = $aps_filler_texts;
  }

  // ##########################################################################
  // TEMPLATING.

  public function locate_template($template_name, $is_twig = TRUE) {
    $src = APS_TEMPLATES;

    if (!empty($is_twig)) {
      $extension = $this->config->get('templating')['twig_template_extension'];
    }
    else {
      $extension = $this->config->get('templating')['php_template_extension'];
    }
    return $src . '/' . $template_name . $extension;
  }

  public function render($template_name, $variables, $is_twig = TRUE) {
    if (!empty($is_twig)) {
      try {
        $output = $this->twig->render(
          $template_name . $this->config->get('templating')['twig_template_extension'],
          $variables
        );
      }
      catch (Exception $e) {
        $output = 'Caught exception: ' . $e->getMessage();
      }
    }
    else {
      // Turn the variables array into separate variables.
      foreach ($variables as $key => $val) {
        $$key = $val;
      }
      unset($key, $val);

      ob_start();
      include($this->locate_template($template_name, $is_twig));
      $output = ob_get_clean();
    }
    return $output;
  }

  public function add_filler_text($group, $instance) {
    $text = $this->filler_texts[$group][$instance];
    return Markdown::defaultTransform($text);
  }


  // ##########################################################################
  // SHORTCUTS TO RENDER COMMON ELEMENTS.

  // --------------------------------------------------------------------------
  // Shortcut to print a regular page header.

  public function render_page_header() {
    $variables = [
      'site_name'      => 'This is the site name',
      'site_slogan'    => 'This is the site slogan',
      'header_widgets' => '', // TODO.
    ];
    return $this->render('page-header', $variables);
  }

  // --------------------------------------------------------------------------
  // Shortcut to print a regular page footer.

  public function render_page_footer() {
    $variables = [
      'footer_widgets' => '', // TODO.
    ];
    return $this->render('page-footer', $variables);
  }

  // ----------------------------------------------------------------------------
  // Shortcut to print a page title.

  public function render_page_title($page_title) {
    return $this->render('page-title', ['page_title' => $page_title]);
  }

  // --------------------------------------------------------------------------
  // Shortcuts to print a .page__level.

  public function page_level_start($additional_classes = []) {
    $orig_classes = [
      'page__level'
    ];
    if (!empty($additional_classes)) {
      $classes = array_merge($orig_classes, $additional_classes);
    }
    else {
      $classes = $orig_classes;
    }
    $prepped_classes = implode(' ', $classes);
    return '<div class="' . $prepped_classes . '">';
  }

  public function page_level_end() {
    return '</div>';
  }

  // --------------------------------------------------------------------------
  // Shortcuts to print a .container.

  public function container_start($additional_classes = []) {
    $orig_classes = [
      'container'
    ];
    if (!empty($additional_classes)) {
      $classes = array_merge($orig_classes, $additional_classes);
    }
    else {
      $classes = $orig_classes;
    }
    $prepped_classes = implode(' ', $classes);
    return '<div class="' . $prepped_classes . '">';
  }

  public function container_end() {
    return '</div>';
  }

  // --------------------------------------------------------------------------
  // Styleguide items' presentation.

  /**
   * Demonstrates a component in a styleguide's component list page.
   *
   * Provides a component title, a component description, a code sample, and a
   * rendered instance of the component.
   *
   * @param array $arguments
   *   string template_name:
   *     Name of the template of the demonstrated component.
   *       Optional.
   *   string title:
   *     The title of the demo.
   *       Mandatory.
   *   string description:
   *     Long text.
   *       Optional.
   *   array component_variables:
   *     Array of data that will populate the rendered demonstrated component.
   *       Optional. (Mandatory if template_name was provided.)
   *   string direct_content:
   *     Directly defined content, for cases when template_name was not passed
   *     in.
   */
  public function render_components_demo_item($arguments, $is_twig = TRUE) {

    // If there's a template named, then we provide its code and then render it
    // with the arguments that were provided for that.
    if (!empty($arguments['template_name'])) {
      $template_name = $arguments['template_name'];

      if (file_exists($this->locate_template($template_name, $is_twig))) {
        $view_code = trim(
          htmlspecialchars(
            file_get_contents($this->locate_template($template_name, $is_twig))
          )
        );
      }
      else {
        $view_code = 'Code not found.';
      }
      $variables_for_code_template = [
        'code' => $view_code,
      ];

      $content_label = 'Rendered sample:';
      $content       = $this->render($template_name, $arguments['component_variables'], $is_twig);
      $code          = $this->render('meta-cd-item-view-code', $variables_for_code_template);
    }
    // Elseif a content was directly provided, we present that.
    elseif (array_key_exists('direct_content', $arguments)) {
      $content_label = FALSE;
      $content       = $arguments['direct_content'];
      $code          = FALSE; // The code template will not print anything.
    }
    else {
      // TODO: error handling.
      echo 'Insufficient arguments for render_cd_item()';
    }

    if (array_key_exists('description', $arguments)) {
      $description = $arguments['description'];
    }
    else {
      $description = FALSE;
    }

    $variables_for_presentation = [
      'title'         => $arguments['title'],
      'description'   => $description,
      'code'          => $code,
      'content_label' => $content_label,
      'content'       => $content,
    ];

    // Render the 'sg-item' template, that is one of the app's own templates.
    return $this->render('meta-components-demo-item', $variables_for_presentation);
  }

  // --------------------------------------------------------------------------
  // Shortcut to print an array of component demo items.

  public function render_component_demos($demos) {
    return $this->render('meta-component-demos', ['demos' => implode(PHP_EOL, $demos)]);
  }
}

