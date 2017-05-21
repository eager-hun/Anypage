<?php

// See http://symfony.com/doc/current/components/http_foundation/introduction.html
// See http://symfony.com/doc/current/book/http_fundamentals.html

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

if (in_array($request_path, $defined_paths)) {
    $manifest_of_requested_resource = $processManager
        ->getConfig('routes')[$request_path];
}
else {
    $manifest_of_requested_resource = $processManager
        ->systemPageManifests['404'];
}

// Allow access to the findings for everybody downstream in the app.
$processManager
    ->setInstruction('resource-manifest', $manifest_of_requested_resource);
