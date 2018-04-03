<?php
require_once ENGINE_DIR . "/files.php";
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/gallery.php";
require_once ENGINE_DIR . "/shop.php";
require_once ENGINE_DIR . "/calc.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        if($action=='deleteimage'){
            if(isset($_POST['image_id'])){
                $id = $_POST['image_id'];
                deleteImageById($id);
                displayMainDocument($parse, 1);
            }
        }else if($action=='calculate'){
            evalCalcForm($parse);
        }else if($action=='addcomment'){
            $itemid = $_GET['item_id'];
            $author = $_POST['author'];
            $comment = $_POST['comment'];
            addComment($author, $comment, $itemid);
            displayItem($parse, $itemid);
        }
            
    }else{
        if(isset($_FILES['photo'])){
            processImage();
            displayMainDocument($parse, 1);
        }
        
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (isset($_GET['image_id'])) {

        returnSinglePictureDocByID($_GET['image_id'], $parse);

    }else if(isset($_GET['section_type'])){
        if($_GET['section_type']=='gallery'){
            displayMainDocument($parse, 1);
        }else if($_GET['section_type']=='calc'){
            displayCalc($parse);
        }
    }else if(isset($_GET['action'])){
        $action = $_GET['action'];
        if($action=='viewcategory'){
            $category = $_GET['category_id'];
            displayShop($parse, $category);
        }else if($action=='viewitem'){
            $id = $_GET['item_id'];
            displayItem($parse, $id);
        }else if($action=='viewgalerysection'){
            $page_no = $_GET['page_no'];
            displayGallerySection($parse, $page_no);
        }else if($action=='deleteimage'){
            $imageid = $_GET['imageid'];
            echo $imageid;

        }
    }else{
        displayShop($parse);
    }
}

?>
