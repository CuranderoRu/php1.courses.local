<?php
require_once ENGINE_DIR . "/files.php";
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/gallery.php";
require_once ENGINE_DIR . "/shop.php";
require_once ENGINE_DIR . "/calc.php";
require_once ENGINE_DIR . "/user.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case "deleteimage":
                if(isset($_POST['image_id'])){
                    $id = $_POST['image_id'];
                    deleteImageById($id);
                    displayMainDocument(1);
                }
                break;
            case "calculate":
                evalCalcForm();
                break;
            case "addcomment":
                $itemid = $_GET['item_id'];
                $author = $_POST['author'];
                $comment = $_POST['comment'];
                addComment($author, $comment, $itemid);
                displayItem($itemid);
                break;
            case "processlogin":
                $login = $_POST['login'];
                $password = $_POST['password'];
                $redirect = 'index.php';
                //var_dump($_POST);
                if(isset($_POST['redirect_arg'])){
                    $redirect = $redirect . $_POST['redirect_arg'];
                }

                if(checkUser($login, $password)){
                    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$redirect);
                }
                
                break;
            case "addtocart":
                $item_id = $_GET['item_id'];
                $quantity = $_POST['quantity'];
                addToCart($item_id, $quantity);
                break;
            case "changecart":
                $item_id = $_GET['item_id'];
                if(!isset($_POST['operation'])){
                    displayCart();
                    exit;
                }
                changeCart($item_id, $_POST['operation']);
                break;

        } 

    }else{
        if(isset($_FILES['photo'])){
            processImage();
            displayMainDocument(1);
        }
        
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (isset($_GET['image_id'])) {
        returnSinglePictureDocByID($_GET['image_id'], $parse);
    }else if(isset($_GET['section_type'])){
        $section_type = $_GET['section_type'];
        switch ($section_type) {
            case "gallery":
                displayMainDocument(1);
                break;
            case "calc":
                displayCalc();
                break;
            case "cart":
                displayCart();
                break;
            case "admin":
                echo 'section is not defined yet';
                break;
        } 
    }else if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case "viewcategory":
                $category = $_GET['category_id'];
                displayShop($category);
                break;
            case "viewitem":
                $id = $_GET['item_id'];
                displayItem($id);
                break;
            case "viewgalerysection":
                $page_no = $_GET['page_no'];
                displayGallerySection($page_no);
                break;
            case "deleteimage":
                $imageid = $_GET['imageid'];
                echo $imageid;
                break;
            case "login":
                login(null,'?action=myaccount');
                break;
            case "logoff":
                closeSession();
                header('Location: http://'.$_SERVER['HTTP_HOST']);
                break;
            case "myaccount":
                showAccountInfo();
                break;

        } 
    }else{
        displayShop();
    }
}

?>
