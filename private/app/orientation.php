<?php

// See http://symfony.com/doc/current/components/http_foundation/introduction.html
// See http://symfony.com/doc/current/book/http_fundamentals.html


$request_uri = $processManager->request->server->get('REQUEST_URI');

$request_path = ltrim(strtok($request_uri, '?'), '/');

$working_dir = $processManager->getConfig('config')['env']['web-working-dir'];

if (!empty($working_dir)) {
    $trim_off = $working_dir . '/';
    $request_path = substr($request_path, strlen($trim_off));

    if ($request_path === false) {
        echo 'NOTICE: the "web_working_directory" entry in config might be wrong.';
        exit;
    }
}

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


// -----------------------------------------------------------------------------
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
    $msg = "Page manifest did not contain 'resource-id', which is an issue.";
    $processManager->sysNotify($msg, 'alert');
}
