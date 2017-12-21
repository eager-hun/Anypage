<?php

use Symfony\Component\HttpFoundation\Response;


// #############################################################################
// Orientation.

require_once(SCRIPT_ROOT . '/private/app/orientation.php');


// #############################################################################
// Building page.

$document = $capacities
    ->get('document-provider')
    ->getDocument();


// #############################################################################
// (Saving static page and) sending response.

if (!empty(BUILDING_STATIC_PAGE)) {
    try {
        $HTML_page_save_result = $capacities
            ->get('site-generator')->saveWebPage($document);

        $document = $HTML_page_save_result;
    }
    catch (HttpException $e) {
        $document = $e->getMessage();
        $status_code_from_exception = $e->getStatusCodeSuggestion();
    }
}

if (!empty($status_code_from_exception)) {
    $status_code = $status_code_from_exception;
}
else {
    $status_code = $processManager->getInstruction('http-response-code-suggestion');
}

$protocol_v = $processManager->getInstruction('http-protocol-v');
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
