<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


// #############################################################################
// ESTABLISHING RESOURCE INFO.

define('DIRECTOR_DIR',      dirname(__FILE__));
define('PRIVATE_RESOURCES', DIRECTOR_DIR . '/private');
define('PUBLIC_RESOURCES',  DIRECTOR_DIR . '/public');

$active_site = 'example-website';

define('ANYPAGES',          PRIVATE_RESOURCES . '/anypages/' . $active_site);

define('CONFIGS',           ANYPAGES . '/config');
define('APS_DEFINITIONS',   ANYPAGES . '/definitions');
define('APS_CONTENTS',      ANYPAGES . '/contents');
define('TEMPLATES',         PRIVATE_RESOURCES . '/templates');


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
$capacities::bind('templating', new Templating(
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
$capacities::bind('navigation', new Navigation(
    $processManager,
    $capacities
));
$capacities::bind('content-provider', new ContentProvider(
    $processManager,
    $capacities
));
$capacities::bind('document-provider', new DocumentProvider(
    $processManager,
    $capacities
));
$capacities::bind('site-generator', new SiteGenerator(
    $processManager,
    $capacities
));

$templating_config = $processManager
    ->getConfig('config')['app']['templating'];

if ( ! empty($templating_config['enable-twig'])) {
    $twig = require_once(PRIVATE_RESOURCES . '/app/twig-setup.php');

    $capacities::bind('twig', $twig);
}


// ############################################################################
// Inviting the app to do the job.

require_once(PRIVATE_RESOURCES . '/app/app.php');
