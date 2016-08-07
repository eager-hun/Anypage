<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Michelf\Markdown;


// ############################################################################
// DEFINITIONS.

DEFINE('CONTROLROOM',     SCRIPT_ROOT . '/controlroom');
DEFINE('ENGINEROOM',      SCRIPT_ROOT . '/engineroom');
DEFINE('APP_SCRIPTS',     ENGINEROOM . '/app');

DEFINE('APS',             SCRIPT_ROOT . '/anypages');
DEFINE('APS_TEMPLATES',   APS . '/templates');
DEFINE('APS_CONTENTS',    APS . '/contents');
DEFINE('APS_DEFINITIONS', APS . '/definitions');


// ############################################################################
// INITIALIZING RESOURCES.

require_once(ENGINEROOM . '/libraries-backend/autoload.php');

// ----------------------------------------------------------------------------
// HTTP FOUNDATION.
// See http://symfony.com/doc/current/components/http_foundation/introduction.html .
// See http://symfony.com/doc/current/book/http_fundamentals.html .
$Request = new Request(
  $_GET,
  $_POST,
  array(),
  $_COOKIE,
  $_FILES,
  $_SERVER
);

// ----------------------------------------------------------------------------
// TWIG.
// See http://twig.sensiolabs.org/doc/api.html#environment-options .
$twig_loader = new Twig_Loader_Filesystem(APS_TEMPLATES);
$twig = new Twig_Environment($twig_loader, [
  'debug'            => FALSE,
  'cache'            => FALSE,
  'strict_variables' => FALSE,
  'autoescape'       => FALSE,
  'optimizations'    => -1
]);

// ----------------------------------------------------------------------------
// MARKDOWN testing.
// echo Markdown::defaultTransform('_italic_');

// ----------------------------------------------------------------------------
// Custom resources.

require_once(CONTROLROOM . '/Config.php');
require_once(CONTROLROOM . '/ApsSetup.php');
require_once(APP_SCRIPTS . '/ProcessInfo.php');
require_once(APP_SCRIPTS . '/Engine.php');
require_once(APP_SCRIPTS . '/ContentProvider.php');
require_once(APP_SCRIPTS . '/PageProvider.php');

require_once(APS . '/ApsHelper.php');

$Config          = new Config();
$ApsSetup        = new ApsSetup();
$ProcessInfo     = new ProcessInfo();
$Engine          = new Engine($Config, $ApsSetup, $ProcessInfo);
$ApsHelper       = new ApsHelper(
  $Config,
  $twig
);
$ContentProvider = new ContentProvider(
  $ProcessInfo,
  $ApsSetup,
  $ApsHelper
);
$PageProvider    = new PageProvider (
  $ApsSetup,
  $ProcessInfo,
  $ContentProvider,
  $Engine,
  $ApsHelper
);

require_once(APP_SCRIPTS . '/utility_functions.php');


// ############################################################################
// "ROUTING".

$page_content = ''; // Fallback.

require_once(APP_SCRIPTS . '/routing.php');


// ############################################################################
// SENDING RESPONSE.
// See http://symfony.com/doc/current/components/http_foundation/introduction.html#response .
// See libraries-backend/symfony/http-foundation/Response.php

$Response = new Response();
$Response->setProtocolVersion('1.1');

if (!empty($document)) {
  $Response->headers->set('Content-Type', 'text/html');

  // 200.
  if ($ProcessInfo->get('page_id') != 'app_404') {
    if (BUILDING_STATIC_FILE) {
      $Engine->savePageAsHTML($Request, $Response, $ApsSetup, $ProcessInfo, $document);
    }
    else {
      // Send back page.
      $Response->setContent($document);
      $Response->setStatusCode(Response::HTTP_OK);
    }
  }
  // 404.
  else {
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

