<?php

// See http://symfony.com/doc/current/components/http_foundation/introduction.html
// See http://symfony.com/doc/current/book/http_fundamentals.html


// #############################################################################
// Determining the actually requested path.

$request_uri = $processManager->request->server->get('REQUEST_URI');
$request_path_actual = ltrim(
    $processManager->request->getPathInfo(),
    '/'
);

$nice_url_mode = $processManager->getConfig('config')['app']['nice-urls'];

if ($nice_url_mode) {
    $working_dir = $processManager->getConfig('config')['env']['web-working-dir'];

    if ( ! empty($working_dir)) {
        $trim_off = $working_dir . '/';
        $request_path = substr($request_path_actual, strlen($trim_off));

        // Possible indication of an error.
        if ($request_path === false) {
            echo 'NOTE: the "web-working-dir" entry in config might be wrong.';
            exit;
        }
    }
    else {
        $request_path = $request_path_actual;
    }
}
else {

    // Bad request.
    if ( ! empty($request_path_actual)) {
        echo 'NOTE: while "Nice URLs" are off, requesting an actual URL path is meaningless.';
        $processManager->response->setStatusCode(400);
        $processManager->response->send();
        exit;
    }

    // NOTE: that's the "path" GET param's value.
    $request_path = $processManager->request->query->get('path');
}


// #############################################################################
// Match the path for a page in the config.

$routes_config = $processManager->getConfig('routes');
$defined_paths = array_keys($routes_config);

$identified_route_index = array_search($request_path, $defined_paths);

if ($identified_route_index !== false) {
    $manifest_of_requested_resource =
        $routes_config[$defined_paths[$identified_route_index]];
}
else {
    $manifest_of_requested_resource = $processManager
        ->systemPageManifests['on_demand']['404'];
}


// #############################################################################
// Allow access to the findings for everybody downstream in the app.

if (!empty($processManager->request->query->get('savePage'))) {
    define('BUILDING_STATIC_PAGE', true);
}
else {
    define('BUILDING_STATIC_PAGE', false);
}

$processManager->setBaseUrl();

$processManager
    ->setInstruction(
        'resource-manifest',
        $manifest_of_requested_resource
    );

if (array_key_exists('resource-id', $manifest_of_requested_resource)) {
    $processManager
        ->setInstruction(
            'resource-id',
            $manifest_of_requested_resource['resource-id']
        );
}
else {
    $msg = "Page manifest did not contain 'resource-id' for this page, which is"
        . "an issue.";
    $processManager->sysNotify($msg, 'alert');
}
