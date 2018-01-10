<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


// #############################################################################
// ESTABLISHING RESOURCE INFO.

define('DIRECTOR_DIR',      dirname(__FILE__));
define('PRIVATE_RESOURCES', DIRECTOR_DIR . '/private');
define('PUBLIC_RESOURCES',  DIRECTOR_DIR . '/public');

define('ANYPAGES',          PRIVATE_RESOURCES . '/anypages');
define('APS_DEFINITIONS',   ANYPAGES . '/definitions');
define('APS_CONTENTS',      ANYPAGES . '/contents');
define('APS_TEMPLATES',     ANYPAGES . '/templates');


// #############################################################################
// Initializing ProcessManger.

// `composer dump-autoload`
require_once(PRIVATE_RESOURCES . '/libraries-backend/autoload.php');

// See http://symfony.com/doc/current/components/http_foundation/introduction.html
// See http://symfony.com/doc/current/book/http_fundamentals.html

$processManager = new ProcessManager(
    new Request(
        $_GET,
        $_POST,
        [],
        $_COOKIE,
        $_FILES,
        $_SERVER
    ),
    new Response,
    new Session
);


// #############################################################################
// Orientation (as early as possible).

require_once(PRIVATE_RESOURCES . '/app/orientation.php');


// #############################################################################
// Initializing the app's capacities.

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
$capacities::bind('asset-management', new AssetManagement(
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

// TWIG.
// See http://twig.sensiolabs.org/doc/api.html#environment-options .

$templating_config = $processManager->getConfig('config')['app']['templating'];

if ( ! empty($templating_config['enable-twig'])) {
    $twig_loader = new Twig_Loader_Filesystem(APS_TEMPLATES);
    $twig_options = $templating_config['twig-renderer-options'];

    $twig = new Twig_Environment($twig_loader, $twig_options);

    if ( ! empty($twig_options['debug'])) {
        $twig->addExtension(new Twig_Extension_Debug());
    }

    $capacities::bind('twig', $twig);
}


// ############################################################################
// Inviting the app to do the job.

require_once(PRIVATE_RESOURCES . '/app/app.php');
