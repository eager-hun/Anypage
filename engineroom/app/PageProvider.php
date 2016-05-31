<?php

class PageProvider {

  private $apsSetup;
  private $processInfo;
  private $contentProvider;
  private $engine;
  private $templating;

  public function __construct(
    ApsSetup $apsSetup,
    ProcessInfo $processInfo,
    ContentProvider $contentProvider,
    Engine $engine,
    Templating $templating
  ) {
    $this->apsSetup           = $apsSetup;
    $this->processInfo        = $processInfo;
    $this->contentProvider    = $contentProvider;
    $this->engine             = $engine;
    $this->templating         = $templating;
  }

  // --------------------------------------------------------------------------
  // METHODS.

  public function buildPage() {
    $page_id = $this->processInfo->get('page_id');
    $content = $this->contentProvider->buildContent($page_id);

    return $this->page($content);
  }

  private function page($page_content) {
    $template_name = 'document';
    $variables = [
      'lang'         => 'en',
      'classes'      => 'no-js',
      'head_title'   => 'Styleguide',
      'head_desc'    => 'HEAD_DESC',
      'styles'       => $this->engine->provideStylesheets(),
      'head_scripts' => $this->engine->provideScripts('head'),
      'page_content' => $page_content,
      'body_scripts' => $this->engine->provideScripts('body'),
    ];

    return $this->templating->render($template_name, $variables, 'app');
  }
}

