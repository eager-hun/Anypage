<?php

// See http://symfony.com/doc/current/components/http_foundation/introduction.html
// See http://symfony.com/doc/current/book/http_fundamentals.html

//var_dump($processManager->request);
//var_dump($processManager->request->getPathInfo());
//var_dump($processManager->request->getContent());
//var_dump($processManager->request->attributes);
//var_dump($processManager->request->request);
//var_dump($processManager->request->query);
//var_dump($processManager->request->server);
//var_dump($processManager->request->files);
//var_dump($processManager->request->cookies);
//var_dump($processManager->request->headers);


$request_uri = $processManager->request->server->get('REQUEST_URI');

$request_path = ltrim(strtok($request_uri, '?'), '/');

$working_dir = $processManager->getConfig('config')['env']['working-dir'];

if (!empty($working_dir)) {
    $trim_off = $working_dir . '/';
    $request_path = substr($request_path, strlen($trim_off));
}

$defined_paths = array_keys($processManager->getConfig('routes'));

// -----------------------------------------------------------------------------
// Allow access to the findings for everybody downstream in the app.

if (in_array($request_path, $defined_paths)) {
    $manifest_of_requested_resource = $processManager
        ->getConfig('routes')[$request_path];
}
else {
    $manifest_of_requested_resource = $processManager
        ->systemPageManifests['on_demand']['404'];
}

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
