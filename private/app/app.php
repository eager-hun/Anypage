<?php

use Symfony\Component\HttpFoundation\Response;


// #############################################################################
// Orientation.

require_once(SCRIPT_ROOT . '/private/app/orientation.php');


// #############################################################################
// Doing business.

$document = $capacities
    ->get('document-provider')
    ->getDocument();


// #############################################################################
// Response.

$protocol_v = $processManager->getInstruction('http-protocol-v');
$response_code_instruction = $processManager->getInstruction('http-response-code');

if ($response_code_instruction == '200') {
    $status_code = Response::HTTP_OK;
}
elseif ($response_code_instruction == '404') {
    $status_code = Response::HTTP_NOT_FOUND;
}
else {
    $status_code = Response::HTTP_I_AM_A_TEAPOT;
}

$processManager->response->setProtocolVersion($protocol_v);
$processManager->response->headers->set('Content-Type', 'text/html');
$processManager->response->setContent($document);
$processManager->response->setStatusCode($status_code);
$processManager->response->prepare($processManager->request);

$processManager->dumpNotifications();

if (function_exists('script_diagnostics')) {
    echo script_diagnostics();
}

$processManager->response->send();
