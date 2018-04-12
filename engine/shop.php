<?php
require_once ENGINE_DIR . "/mySQL.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/user.php";

function getCategoryList($parse){
    $return = "";
    $res = selectAll("SELECT id, name FROM categories");
    foreach ($res as &$value) {
        $parse->get_tpl(TEMPLATES_DIR . "/categoryitem.tpl");
        $parse->set_tpl('{categoryid}',$value['id']); 
        $parse->set_tpl('{categoryname}',$value['name']); 
        $parse->tpl_parse();
        $return = $return . $parse->template;
    }
    unset($value);
    return $return;
}

function getItemsList($parse, $category=null, $section="shop"){
    $return = "";
    $sql = "SELECT * FROM items";
    
    if(!$category==null){
        $category=checkParam($category);
        $sql = $sql . " WHERE category = {$category}";
    }
    
    if($section=="shop"){
        $shop_actions_visibility = (isAuthenticated()) ? "" : "invisible";
        $cart_actions_visibility = "invisible";
    }else if($section=="cart"){
        $shop_actions_visibility = "invisible";
        $cart_actions_visibility = "";
    }

    $res = selectAll($sql);
    foreach ($res as &$value) {
        $return = $return . renderTpl("shopitem.tpl", array(
        '{item_id}' => $value['id'], 
        '{item_img}' => $value['image'],
        '{item_descr}' => $value['name'],
        '{item_comment}' => $value['comment'],
        '{item_price}' => $value['price'],
        '{quantity}' => 1,
        '{shop_actions_visibility}' => $shop_actions_visibility, 
        '{cart_actions_visibility}' => $cart_actions_visibility
        ), $parse);
    }
    unset($value);
    return $return;
}

function getCartItems(){
    $parse = new parse_class;
    if(!isAuthenticated()){
        return "Вы не авторизованы";
    }
    if(!isset($_SESSION['cart_list'])){
        return "В корзине ничего нет";
    }
    $return = "";
    foreach ($_SESSION['cart_list'] as $key => $value) {
        $row = selectOne("SELECT * FROM items WHERE id = '{$key}'");
        $return = $return . renderTpl("shopitem.tpl", array(
        '{item_id}' => $key, 
        '{item_img}' => $row['image'],
        '{item_descr}' => $row['name'],
        '{item_comment}' => $row['comment'],
        '{item_price}' => $row['price'],
        '{quantity}' => $value,
        '{shop_actions_visibility}' => "invisible", 
        '{cart_actions_visibility}' => ""
        ), $parse);
    }
    unset($value);
    return $return;
    
}

function getCartMenuItems(){
    $parse = new parse_class;
    $return = "";
    if(isAuthenticated()){
        $return = $return . renderTemplate('cartmenuitem', array(
        'itemlink' => '../shop/logoff.php',
        'itemtext' => 'Log off'
        )
        );
    }else{
        $return = $return . renderTemplate('cartmenuitem', array(
        'itemlink' => '../shop/login.php',
        'itemtext' => 'Sign in'
        )
        );
        $return = $return . renderTemplate('cartmenuitem', array(
        'itemlink' => 'register.php',
        'itemtext' => 'Sign up'
        )
        );
    }
    
    return $return;
}

function displayShop($category = null, $cart_only=false){
    $parse = new parse_class;
    $categories = getCategoryList($parse);
    if($cart_only){
        $items = getCartItems();
    }else{
        $items = getItemsList($parse, $category);
    }
    print renderTpl("shop.tpl", array(
        '{shopcategories}' => $categories,
        '{cart_menu_items}' => getCartMenuItems(),
        '{shopitems}' => $items
    ), $parse);
}

function extractComments($itemid){
    $parse = new parse_class;
    $return = "";
    $res = selectAll("SELECT name, comment_date, comment FROM comments WHERE item = {$itemid}");
    foreach ($res as &$value) {
        $return = $return . renderTpl("commentsection.tpl", array(
            '{AUTHOR}' => $value['name'],
            '{COMMDATE}' => $value['comment_date'],
            '{COMMENT}' => $value['comment']
        ), $parse);
    }
    unset($value);
    
    return $return;
}

function displayItem($itemid){
    $itemid = checkParam($itemid);
    $comments = extractComments($itemid);
    $value = selectOne("SELECT * FROM items WHERE id = {$itemid}");
    print renderTpl("itempage.tpl", array(
        '{item_id}' => $value['id'],
        '{item_img}' => $value['image'],
        '{item_descr}' => $value['name'],
        '{item_comment}' => $value['comment'],
        '{item_price}' => $value['price'],
        '{COMMENTS}' => $comments
        ), new parse_class);
}

function addComment($author,$comment,$itemid){
    $itemid = checkParam($itemid);
    $author = checkParam($author);
    $comment = checkParam($comment);
    $date = date('c');
    if(!empty($author)&!empty($comment)){
        executeSQL("INSERT INTO comments (item, comment_date, name, comment) VALUES ('{$itemid}', '{$date}','{$author}','{$comment}')");
    }
}

function login($message = null, $redirect = null){
    $params = array(
                    'message' => "",
                    'redirect' => ""
                   );
    
    if(!is_null($redirect)){
        $params['redirect'] = $redirect;
    }
    if(!is_null($message)){
        if(!$message){
            $params['message'] = "Неверный логин или пароль, повторите попытку";
        }
    }
    print renderTemplate('login', $params);
}

function displayCart($message = null){
    if(isAuthenticated()){
        displayShop(null, true);
    }else{
        login($message);
    }
}

function addToCart($item_id, $quantity){
    if(isAuthenticated()){
        if(!isset($_SESSION['cart_list'])){
            $_SESSION['cart_list'] = [];
        }
        if(isset($_SESSION['cart_list']["{$item_id}"])){
            $_SESSION['cart_list']["{$item_id}"] = $_SESSION['cart_list']["{$item_id}"] + $quantity;
        }else{
            $_SESSION['cart_list']["{$item_id}"] = $quantity;
        }
        displayShop();
    }else{
        $params = ["message", ""];
        print renderTemplate('login', $params);
    }
}

function changeCart($item_id, $operation){
    if(!isAuthenticated()){
        displayShop();
        return;
    }
    if(isset($_SESSION['cart_list']["{$item_id}"])){
        switch ($operation) {
            case "+":
                $_SESSION['cart_list']["{$item_id}"] = $_SESSION['cart_list']["{$item_id}"] + 1;
                break;
            case "-":
                $_SESSION['cart_list']["{$item_id}"] = ($_SESSION['cart_list']["{$item_id}"] <= 1) ? 0 : $_SESSION['cart_list']["{$item_id}"]-1;
                break;
            case "X":
                unset($_SESSION['cart_list']["{$item_id}"]);
                break;
        } 
    }
    displayCart();
}

function showAccountInfo(){
    if(!isAuthenticated()){
        displayShop();
        return;
    }
    $params = array(
                    'name' => $_SESSION['name'],
                    'login' => $_SESSION['login'],
                    'last_login' => $_SESSION['last_login']
                    );

    print renderTemplate('myaccountinfo', $params);
}

?>