<?php

function uploadFile($destination, $attributeName = 'file', $callback = null){
    if(isset($_FILES[$attributeName])){
        $tmp = $_FILES[$attributeName]['tmp_name'];
        $filePath = $destination . $_FILES[$attributeName]['name'];
        move_uploaded_file($tmp, $filePath);
        
        if(!is_null($callback)){
            $callback($_FILES[$attributeName]);
        }
        
    }
    return $filePath;
    
}

function processImage(){
    require_once VENDOR_DIR . "/funcImgResize.php";
    $dir = PICS_DIR . "/";
    $filePath = uploadFile($dir, 'photo', function($file) use ($dir){
        $filename = $file['name'];
        img_resize($dir . $filename, TUMBS_DIR . "/". $filename, 200, 150);
        addToDatabase($filename);
    });
    return $filePath;
}

function getFilesArray($dir = PICS_DIR, $mask = '*.jpg'){
    $arFileList = glob($dir . "/" . $mask , GLOB_NOSORT);
    $arFileList = str_replace ($dir . '/' , '' , $arFileList);
    return $arFileList;
}

function deleteFile($filename){
    return unlink ( $filename );
}

?>
