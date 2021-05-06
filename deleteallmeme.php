<?php
header('Content-type: application/json');
require "__common-functions.php";

if (isset($_POST["memes"])) {
    try {
      $arr = array();
      $memes = json_decode($_POST["memes"]);
      print_r($memes);
      $isDeleted = deleteAllMeme($memes);
      if($isDeleted){
         $arr["status"] = 200;
         $arr["success"] = true;
         echo json_encode($arr);
         http_response_code(200);
      }else{
         throw new Exception();
      }

    } catch (Exception $e) {
      $arr = array();
      $arr["success"] = false;
      $arr["status"] = 400;
      echo json_encode($arr);
      http_response_code(400);
    }

}