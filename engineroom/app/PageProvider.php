<?php

class PageProvider {

  private $config;
  private $apsSetup;
  private $processInfo;
  private $contentProvider;
  private $engine;
  private $apsHelper;

  public function __construct(
    Config $config,
    ApsSetup $apsSetup,
    ProcessInfo $processInfo,
    ContentProvider $contentProvider,
    Engine $engine,
    ApsHelper $apsHelper
  ) {
    $this->config          = $config;
    $this->apsSetup        = $apsSetup;
    $this->processInfo     = $processInfo;
    $this->contentProvider = $contentProvider;
    $this->engine          = $engine;
    $this->apsHelper       = $apsHelper;
  }

  public function renderPage() {

    // Prepare the app menu.
    $page_id = $this->processInfo->get('page_id');
    $page_content = $this->contentProvider->renderContent($page_id);
    $app_menu_template_vars = [
      'app_menu' => $this->engine->provideAppMenu(),
    ];

    // Prepare the contents of the <body>.
    $variables_for_page = [
      'page_header' => $this->apsHelper->render_page_header(),
      'page_main'   => $page_content,
      'page_footer' => $this->apsHelper->render_page_footer(),
      'app_menu'    => $this->apsHelper->render(
        'app-meta/app-menu-wrapper',
        $app_menu_template_vars
      ),
    ];

    $document_properties = $this->apsSetup->get('document_properties');

    // Prepare the variables for <html>.
    $variables_for_document = [
      'lang'             => $document_properties['html_lang'],
      'classes_for_html' => 'no-js',
      'head_title'       => $document_properties['head_title'],
      'head_desc'        => $document_properties['head_desc'],
      'head_misc'        => '',
      'styles'           => $this->engine->provideStylesheets(),
      'scripts_in_head'  => $this->engine->provideScripts('head'),
      'page_content'     => $this->apsHelper->render('page', $variables_for_page),
      'scripts_in_body'  => $this->engine->provideScripts('body'),
    ];

    $this->documentHeadAdditions($variables_for_document);

    // Render the complete <html> tag.
    return $this->apsHelper->render('document', $variables_for_document);
  }

  protected function documentHeadAdditions(&$variables_for_document) {

    $favicon = <<<EOT
      <!-- That's an empty favicon, prevents 404s. -->
      <link rel="icon" href="data:;base64,iVBORw0KGgo=">
EOT;
    $variables_for_document['head_misc'] .= PHP_EOL . $favicon;

    if (!empty($this->config->get('enable_livereload'))
        && empty(BUILDING_STATIC_FILE)) {
      // See http://stackoverflow.com/questions/26069796/gulp-how-to-implement-livereload-without-chromes-livereload-plugin
      $livereload_script = '<script src="http://localhost:35729/livereload.js?snipver=1"></script>';
      $variables_for_document['head_misc'] .= PHP_EOL . $livereload_script;
    }
  }
}

