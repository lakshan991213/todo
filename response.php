<?php

function sendResponse($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function sendError($message, $status = 400) {
    sendResponse(['error' => $message], $status);
}

?>
