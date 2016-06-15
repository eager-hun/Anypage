<?php

// ############################################################################
// DEFINITIONS.

DEFINE('CONTROLROOM',     SCRIPT_ROOT . '/controlroom');
DEFINE('ENGINEROOM',      SCRIPT_ROOT . '/engineroom');

DEFINE('APP_SCRIPTS',     ENGINEROOM . '/app');
DEFINE('APP_ASSETS',      ENGINEROOM . '/app-assets');

DEFINE('APS',             SCRIPT_ROOT . '/anypages');

DEFINE('APS_TEMPLATES',   APS . '/aps-templates');
DEFINE('APS_CONTENTS',    APS . '/aps-contents');
DEFINE('APS_ASSETS',      APS . '/aps-assets');
DEFINE('APS_DEFINITIONS', APS . '/aps-definitions');


// ############################################################################
// INITIALIZING RESOURCES.

require_once(ENGINEROOM . '/libraries-backend/autoload.php');

// ----------------------------------------------------------------------------
// HttpFoundation.
// See http://symfony.com/doc/current/components/http_foundation/introduction.html .
// See http://symfony.com/doc/current/book/http_fundamentals.html .
use Symfony\Component\HttpFoundation\Request;
$Request = new Request(
    $_GET,
    $_POST,
    array(),
    $_COOKIE,
    $_FILES,
    $_SERVER
);

// ----------------------------------------------------------------------------
// Markdown.
//use \Michelf\Markdown;
//print Markdown::defaultTransform('_italic_');


// ----------------------------------------------------------------------------
// Custom classes.

require_once(CONTROLROOM . '/Config.php');
require_once(APP_SCRIPTS . '/ProcessInfo.php');

require_once(APP_SCRIPTS . '/Utils.php');
require_once(APP_SCRIPTS . '/Templating.php');
require_once(APP_SCRIPTS . '/Engine.php');
require_once(CONTROLROOM . '/ApsSetup.php');
require_once(APP_SCRIPTS . '/ContentProvider.php');
require_once(APP_SCRIPTS . '/PageProvider.php');

$Config            = new Config();
$ApsSetup          = new ApsSetup();

$ProcessInfo       = new ProcessInfo();
$Utils             = new Utils($Config, $Request);
$Templating        = new Templating($Config);

$Engine            = new Engine($Config, $ApsSetup, $Utils);
$ContentProvider   = new ContentProvider($ApsSetup, $Templating);

$PageProvider      = new PageProvider (
  $ApsSetup,
  $ProcessInfo,
  $ContentProvider,
  $Engine,
  $Templating
);


// ############################################################################
// "ROUTING".

$page_content = ''; // Fallback.

require_once(APP_SCRIPTS . '/routing.php');


// ############################################################################
// SENDING RESPONSE.
// See http://symfony.com/doc/current/components/http_foundation/introduction.html#response .
// See libraries-backend/symfony/http-foundation/Response.php

use Symfony\Component\HttpFoundation\Response;

$Response = new Response();
$Response->setProtocolVersion('1.1');

if (!empty($document)) {
  $Response->headers->set('Content-Type', 'text/html');

  if ($ProcessInfo->get('page_id') != 'app_404') {
    // 200.
    $Response->setContent($document);
    $Response->setStatusCode(Response::HTTP_OK);
  }
  else {
    // 404.
    $Response->setContent($document);
    $Response->setStatusCode(Response::HTTP_NOT_FOUND);
  }
}
else {
  // 418. (Alternative could be 500.)
  $Response->setContent("<p>Debug o'clock.</p>");
  $Response->headers->set('Content-Type', 'text/plain');
  $Response->setStatusCode(Response::HTTP_I_AM_A_TEAPOT);
}

$Response->prepare($Request);
$Response->send();

