<?php
require_once ENGINE_DIR . "/funcImgResize.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/template.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_FILES['file'])){
        $tmp = $_FILES['file']['tmp_name'];
        copy ($tmp, TUMBS_DIR . "/". $_FILES['file']['name']);
        move_uploaded_file($tmp, PICS_DIR . "/". $_FILES['file']['name']);
        img_resize(PICS_DIR . "/". $_FILES['file']['name'], TUMBS_DIR . "/". $_FILES['file']['name'], 80, 80);
        addToDatabase($_FILES['file']['name']);
    }
}else{
    if (isset($_GET['image_id'])) {

        returnSinglePictureDocByID($_GET['image_id'], $parse);

    }else{
        displayMainDocument($parse, 1);
    }
}


//displayMainDocument($parse, 1);

?>
