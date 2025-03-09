<?php

function response($success, $message, $data = null)
{
    $responseArray = ["success" => $success,"message" => $message];

    if ($data !== null) {
        $responseArray["data"] = $data;
    }
    echo json_encode($responseArray);
    exit;
}
function getJsonRequestData()
{
    return json_decode(file_get_contents("php://input"), true);
}
?>