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

