<?php
header('Content-type: application/json');

require "__common-functions.php";
if (isset($_POST) && isset($_FILES["meme"])) {
    try {
        $arr = array();
        isItImage($_FILES["meme"]);
        checkFileSize($_FILES["meme"]);
        $new_name = moveMeme($_FILES["meme"]);
        $arr["status"] = 200;
        $arr["success"] = true;
        $arr["image_new_name"] = $new_name;
        http_response_code(200);
        echo json_encode($arr);

    } catch (Exception $e) {
        http_response_code(400);
        echo $e->getMessage();

    }
}

if (isset($_POST) && isset($_FILES["profilePic"])) {
    try {
        $arr = array();
        isItImage($_FILES["profilePic"]);
        checkFileSize($_FILES["profilePic"]);
        $new_name = moveProfilePicture($_FILES["profilePic"]);
        $arr["status"] = 200;
        $arr["success"] = true;
        $arr["image_new_name"] = $new_name;
        http_response_code(200);
        echo json_encode($arr);

    } catch (Exception $e) {
        http_response_code(400);
        echo $e->getMessage();
    }

}
