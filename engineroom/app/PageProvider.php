<?php

class PageProvider {

  private $apsSetup;
  private $processInfo;
  private $contentProvider;
  private $engine;
  private $apsHelper;

  public function __construct(
    ApsSetup $apsSetup,
    ProcessInfo $processInfo,
    ContentProvider $contentProvider,
    Engine $engine,
    ApsHelper $apsHelper
  ) {
    $this->apsSetup        = $apsSetup;
    $this->processInfo     = $processInfo;
    $this->contentProvider = $contentProvider;
    $this->engine          = $engine;
    $this->apsHelper       = $apsHelper;
  }

  // --------------------------------------------------------------------------
  // METHODS.

  public function renderPage() {

    $page_id = $this->processInfo->get('page_id');
    $page_content = $this->contentProvider->renderContent($page_id);
    $app_menu_template_vars = [
      'app_menu' => $this->engine->provideAppMenu(),
    ];

    $variables_for_page = [
      'page_header' => $this->apsHelper->render_page_header(),
      'page_main'   => $page_content,
      'page_footer' => $this->apsHelper->render_page_footer(),
      'app_menu'    => $this->apsHelper->render(
        'app-meta/app-menu-wrapper',
        $app_menu_template_vars
      ),
    ];

    $variables_for_document = [
      'lang'         => 'en',
      'classes'      => 'no-js',
      'head_title'   => 'Styleguide',
      'head_desc'    => 'HEAD_DESC',
      'styles'       => $this->engine->provideStylesheets(),
      'head_scripts' => $this->engine->provideScripts('head'),
      'page_content' => $this->apsHelper->render('page', $variables_for_page),
      'body_scripts' => $this->engine->provideScripts('body'),
    ];

    return $this->apsHelper->render('document', $variables_for_document);
  }
}

