<?php

require "__common-constants.php";

function isItImage($file)
{
    $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
    $arr = array();
    if ($ext === "jpg" || $ext === "png" || $ext === "gif") {
        return true;
    }
    $arr["error"] = "$ext extension is not acceptable";
    $arr["success"] = false;
    $arr["status"] = 400;
    throw new Exception(json_encode($arr));
}

function checkFileSize($file)
{
    $arr = array();
    if ($file["size"] > 300000) {
        $arr["error"] = "file size is more than 300kb";
        $arr["success"] = false;
        $arr["status"] = 400;
        throw new Exception(json_encode($arr));
    } else {
        return true;
    }
}

function moveProfilePicture($file)
{

    $arr = array();
    $new_name = time() . $file["name"];
    $isFileUploaded = move_uploaded_file($file["tmp_name"], profile_pic_dir . $new_name);
    if (!$isFileUploaded) {
        $arr["error"] = "something went wrong.please try again";
        $arr["success"] = false;
        $arr["status"] = 400;
        throw new Exception(json_encode($arr));
    }else{
      return $new_name;
    }

}

function moveMeme($file)
{

    $arr = array();
    $new_name = time() . $file["name"];
    $isFileUploaded = move_uploaded_file($file["tmp_name"], meme_dir . $new_name);
    if (!$isFileUploaded) {
        $arr["error"] = "something went wrong.please try again";
        $arr["success"] = false;
        $arr["status"] = 400;
        throw new Exception(json_encode($arr));
    }else{
      return $new_name;
    }

}

function deleteProfile($name){
    try {
        return unlink(profile_pic_dir.$name);
    }catch(Exception $e){
        throw $e;
    }
}

function deleteMeme($name){
    try {
        return unlink(meme_dir.$name);
    }catch(Exception $e){
        throw $e;
    }
}

function deleteAllMeme($name){
    try{
        $result = false;
        foreach($name as $image){
            $isDeleted =  unlink(meme_dir.$image);
            if($isDeleted){
                $result = true;
            }else{
                $result = false;
            }
        }
        return $result;
    }catch(Exception $e){
        throw $e;
    }
}