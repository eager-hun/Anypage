<?php

Class Utils {

  private $config;
  private $request;

  public function __construct(
    Config $config,
    Symfony\Component\HttpFoundation\Request $request
  ) {
    $this->config  = $config;
    $this->request = $request;
  }

  public function base_url() {
    $output = $this->config->get('env')['http_protocol'] . '://'
      . $this->request->server->get('HTTP_HOST') . '/'
      . $this->config->get('env')['working_dir'] . '/';
    return $output;
  }
}

