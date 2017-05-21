<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// #############################################################################
// ESTABLISHING RESOURCE INFO.

define('DIRECTOR_DIR',    dirname(__FILE__));
define('PRIVATE_ASSETS',  DIRECTOR_DIR . '/private');
define('PUBLIC_ASSETS',   DIRECTOR_DIR . '/public');

define('ANYPAGES',        PRIVATE_ASSETS . '/anypages');
define('APS_TEMPLATES',   ANYPAGES . '/templates');
define('APS_CONTENTS',    ANYPAGES . '/contents');
define('APS_DEFINITIONS', ANYPAGES . '/definitions');


// #############################################################################
// INITIALIZING RESOURCES.

// composer dump-autoload
require_once(PRIVATE_ASSETS . '/libraries-backend/autoload.php');

// -----------------------------------------------------------------------------
// Initializing ProcessManger.

// HTTP FOUNDATION.
// See http://symfony.com/doc/current/components/http_foundation/introduction.html
// See http://symfony.com/doc/current/book/http_fundamentals.html

$processManager = new ProcessManager(
    new Request(
        $_GET,
        $_POST,
        array(),
        $_COOKIE,
        $_FILES,
        $_SERVER
    ),
    new Response
);

// -----------------------------------------------------------------------------
// Initializing capacities.
// NOTE: is this recursive referencing?
// Do I need to look at anything like this? https://bugs.php.net/bug.php?id=33595

$capacities = new Capacities;

$capacities::bind('security', new Security(
    $processManager
));
$capacities::bind('content-provider', new ContentProvider(
    $processManager,
    $capacities
));
$capacities::bind('document-provider', new DocumentProvider(
    $processManager,
    $capacities
));
$capacities::bind('tools', new Tools(
    $processManager,
    $capacities
));
$capacities::bind('site-generator', new SiteGenerator(
    $processManager,
    $capacities
));
$capacities::bind('system-utils', new SystemUtils(
    $processManager,
    $capacities
));

// TWIG.
// See http://twig.sensiolabs.org/doc/api.html#environment-options .

if ($processManager->getConfig('config')['app']['templating']['enable-twig']) {
    $twig_loader = new Twig_Loader_Filesystem(APS_TEMPLATES);

    $capacities::bind('twig', new Twig_Environment($twig_loader, [
        'debug'            => FALSE,
        'cache'            => FALSE,
        'strict_variables' => FALSE,
        'autoescape'       => FALSE,
        'optimizations'    => -1,
    ]));
}


// ############################################################################
// INVITING THE APP TO DO THE JOB.

require_once(SCRIPT_ROOT . '/private/app/app.php');
