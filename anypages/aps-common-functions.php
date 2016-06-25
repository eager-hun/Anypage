<?php
/**
 * Common functions accessible from all page prescription files.
 */

// ----------------------------------------------------------------------------
// Shortcut to print a regular page header.

function render_page_header() {
  $template_name = 'page-header';
  $variables = [
    'site_name'      => 'This is the site name',
    'site_slogan'    => 'This is the site slogan',
    'header_widgets' => render_page_header_widgets(),
  ];

  $Templating = new Templating(new Config);
  return $Templating->render($template_name, $variables);
}

function render_page_header_widgets() {
  $template_name = 'page-header-widgets';

  $Templating = new Templating(new Config);
  return $Templating->render($template_name, array());
}

// ----------------------------------------------------------------------------
// Shortcut to print a regular page footer.

function render_page_footer() {
  $template_name = 'page-footer';
  $variables = [
    'footer_widgets' => render_page_footer_widgets(),
  ];

  $Templating = new Templating(new Config);
  return $Templating->render($template_name, $variables);
}

function render_page_footer_widgets() {
  $template_name = 'page-footer-widgets';

  $Templating = new Templating(new Config);
  return $Templating->render($template_name, array());
}

// ----------------------------------------------------------------------------
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
function render_cd_item($arguments) {
  $Templating = new Templating(new Config);

  // If there's a template named, then we provide its code and then render it
  // with the arguments that were provided for that.
  if (!empty($arguments['template_name'])) {
    $template_name = $arguments['template_name'];

    if (file_exists($Templating->locate_template($template_name))) {
      $view_code = trim(
        htmlspecialchars(
          file_get_contents($Templating->locate_template($template_name))
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
    $content       = $Templating->render($template_name, $arguments['component_variables']);
    $code          = $Templating->render('cd-code-view', $variables_for_code_template);
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
  return $Templating->render('cd-item', $variables_for_presentation);
}

