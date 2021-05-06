<?php
header('Content-type: application/json');
require "__common-functions.php";
if (isset($_POST["singlememe"])) {
    try {
        $arr = array();
        $isDeleted = deleteMeme($_POST["singlememe"]);
        if ($isDeleted) {
            $arr["status"] = 200;
            $arr["success"] = true;
            http_response_code(200);
            echo json_encode($arr);
        } else {
            throw new Exception();
        }
    } catch (Exception $e) {
        $arr = array();
        $arr["success"] = false;
        $arr["status"] = 400;
        http_response_code(400);
        echo json_encode($arr);
    }
}