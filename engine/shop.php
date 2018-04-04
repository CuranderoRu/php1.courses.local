<?php
require_once ENGINE_DIR . "/mySQL.php";

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

function getItemsList($parse, $category=null){
    $return = "";
    $sql = "SELECT * FROM items";
    if(!$category==null){
        $category=checkParam($category);
        $sql = $sql . " WHERE category = {$category}";
    }
    $res = selectAll($sql);
    foreach ($res as &$value) {
        $parse->get_tpl(TEMPLATES_DIR . "/shopitem.tpl");
        $parse->set_tpl('{item_id}',$value['id']); 
        $parse->set_tpl('{item_img}',$value['image']); 
        $parse->set_tpl('{item_descr}',$value['name']); 
        $parse->set_tpl('{item_comment}',$value['comment']); 
        $parse->set_tpl('{item_price}',$value['price']); 
        $parse->tpl_parse();
        $return = $return . $parse->template;
    }
    unset($value);
    return $return;
}

function displayShop($parse, $category = null){
    echo $category;
    echo '<br>';
    $categories = getCategoryList($parse);
    $items = getItemsList($parse, $category);
    $parse->get_tpl(TEMPLATES_DIR . "/shop.tpl");
    $parse->set_tpl('{shopcategories}',$categories); 
    $parse->set_tpl('{shopitems}', $items);
    $parse->tpl_parse();
    print $parse->template;
}

function extractComments($parse, $itemid){
    $return = "";
    $res = selectAll("SELECT name, comment_date, comment FROM comments WHERE item = {$itemid}");
    foreach ($res as &$value) {
        $parse->get_tpl(TEMPLATES_DIR . "/commentsection.tpl");
        $parse->set_tpl('{AUTHOR}',$value['name']); 
        $parse->set_tpl('{COMMDATE}',$value['comment_date']); 
        $parse->set_tpl('{COMMENT}',$value['comment']); 
        $parse->tpl_parse();
        $return = $return . $parse->template;

    }
    unset($value);
    
    return $return;
}

function displayItem($parse, $itemid){
    $itemid = checkParam($itemid);
    $comments = extractComments($parse, $itemid);
    $res = selectAll("SELECT * FROM items WHERE id = {$itemid}");
    $parse->get_tpl(TEMPLATES_DIR . "/itempage.tpl");
    foreach ($res as &$value) {
        $parse->set_tpl('{item_id}',$value['id']); 
        $parse->set_tpl('{item_img}',$value['image']); 
        $parse->set_tpl('{item_descr}',$value['name']); 
        $parse->set_tpl('{item_comment}',$value['comment']); 
        $parse->set_tpl('{item_price}',$value['price']); 
        $parse->set_tpl('{COMMENTS}',$comments); 
    }
    unset($value);
    $parse->tpl_parse();
    print $parse->template;
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

?>