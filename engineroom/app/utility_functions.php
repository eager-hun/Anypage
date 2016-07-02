<?php

function apputils_base_url() {
  // FIXME?
  global $Request;

  $config = new Config;
  $output = $config->get('env')['http_protocol'] . '://'
    . $Request->server->get('HTTP_HOST') . '/'
    . $config->get('env')['working_dir'] . '/';
  return $output;
}

function apputils_string_valid_as($string, $as) {
  if ($as == 'dirname') {
    $non_valid_parts = preg_replace('#[-_a-z0-9]#', '', $string);
    return empty(strlen($non_valid_parts));
  }
  else {
    // TODO: message about not understanding instructions.
    return FALSE;
  }
}

function apputils_import_file_content($file, $process = 'php') {
  if (!file_exists($file)) {
    // TODO: error handling.
    return FALSE;
  }

  if ($process == 'php') {
    ob_start();
    include($file);
    return ob_get_clean();
  }
  else {
    // TODO: message about not understanding instructions.
  }
}

function apputils_print_path_to_theme() {
  if (BUILDING_STATIC_FILE) {
    $output = '';
  }
  else {
    $config = new Config;
    $output = $config->get('env')['path_to_theme'] . '/';
  }
  echo $output;
}

