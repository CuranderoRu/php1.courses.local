<?php
require_once ENGINE_DIR . "/mySQL.php";


function getFilesArray(){
    $arFileList = glob(PICS_DIR . "/*.jpg" , GLOB_NOSORT);
    $arFileList = str_replace (PICS_DIR . '/' , '' , $arFileList);
    return $arFileList;
}

function getFilesArraySQL(){
    $conn = mysqli_connect(MYSQL_ADDRESS, MYSQL_LOGIN, MYSQL_PSW, MYSQL_DBNAME);
    $image_id = mysqli_real_escape_string($conn, $image_id);
    $res = query("SELECT file_name, image_id, requests_count FROM images ORDER BY requests_count DESC",$conn);
    mysqli_close($conn);
    return $res;
}


function prepareTemplate($parse, $page_no, $templ_path){
    $parse->get_tpl($templ_path);
    $max_pics = 6;
    $start_img = ($page_no == 0) ? 0 : $page_no * $max_pics - $max_pics;
    //$arFileList = getFilesArray();
    $arFileList = getFilesArraySQL();
    $count = 0;
    $int_count = 0;
    foreach ($arFileList as &$value) {
        if($start_img<=$count && ($start_img+$max_pics)>$count){
            $int_count++;
            //$parse->set_tpl('{IMGLINK' . $int_count . '}','./img/' . $value); 
            $parse->set_tpl('{IMGLINK' . $int_count . '}','index.php?image_id=' . $value['image_id']); 
            $parse->set_tpl('{TUMBLINK' . $int_count . '}','./img/tumbs/' . $value['file_name']); 
            $parse->set_tpl('{ALT' . $int_count . '}', $value['requests_count']);
            $parse->set_tpl('{IMAGEID' . $int_count . '}', $value['image_id']);
        }
        
        $count++;
    }
    unset($value);
    $parse->set_tpl('{IMAGECOUNT}', $int_count);
    $parse->set_tpl('{PREVPAGE}',$page_no-1);
    if($int_count==6){
        $parse->set_tpl('{NEXTPAGE}',$page_no+1);
    }else{
        $parse->set_tpl('{NEXTPAGE}',$page_no);
    }
}


function displayMainDocument($parse, $page_no){
    prepareTemplate($parse, $page_no, TEMPLATES_DIR . '/mainpage.tpl');
    $parse->tpl_parse(); //Парсим
    print $parse->template; //Выводим нашу страничку
}

function displayGallerySection($parse, $page_no){
    prepareTemplate($parse, $page_no, TEMPLATES_DIR . '/sectionGallery.tpl');
    $parse->tpl_parse(); //Парсим
    print $parse->template; //Выводим нашу страничку
}

function returnSinglePictureDocByID($image_id, $parse){
    $conn = mysqli_connect(MYSQL_ADDRESS, MYSQL_LOGIN, MYSQL_PSW, MYSQL_DBNAME);
    $image_id = mysqli_real_escape_string($conn, $image_id);
    query("UPDATE images SET requests_count = requests_count + 1 WHERE image_id={$image_id}",$conn,false);
    $res = query("SELECT file_name, requests_count FROM images WHERE image_id={$image_id}",$conn);
    mysqli_close($conn);
    $parse->get_tpl(TEMPLATES_DIR . "/singleImage.tpl");
    $parse->set_tpl('{PICNAME}', $res[0]["file_name"]); 
    $parse->set_tpl('{PATHTOIMG}', "./img/" . $res[0]["file_name"]); 
    $parse->set_tpl('{ALT}', $res[0]["file_name"]); 
    $parse->set_tpl('{VIEWCOUNT}', $res[0]["requests_count"]); 
    $parse->tpl_parse();
    print $parse->template;
}

function addToDatabase($filename){
    $conn = mysqli_connect(MYSQL_ADDRESS, MYSQL_LOGIN, MYSQL_PSW, MYSQL_DBNAME);
    $image_id = mysqli_real_escape_string($conn, $filename);
    $res = query("INSERT INTO images (`file_name`) VALUES ('{$filename})'",$conn,false);
    mysqli_close($conn);
}