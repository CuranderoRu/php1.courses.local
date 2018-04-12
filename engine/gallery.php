<?php
require_once ENGINE_DIR . "/mySQL.php";


function getFilesArraySQL($image_id = null){
    $sql = "SELECT file_name, image_id, requests_count FROM images";
    if(!is_null($image_id)){
        $sql = $sql . " WHERE image_id={$image_id}";
    }
    
    $sql = $sql . " ORDER BY requests_count DESC";
    return selectAll($sql);
}


function prepareTemplate($parse, $page_no, $templ_path){
    $parse->get_tpl($templ_path);
    $max_pics = 6;
    $start_img = ($page_no == 0) ? 0 : $page_no * $max_pics - $max_pics;
    $arFileList = getFilesArraySQL();
    $count = 0;
    $int_count = 0;
    foreach ($arFileList as &$value) {
        if($start_img<=$count && ($start_img+$max_pics)>$count){
            $int_count++;
            $parse->set_tpl('{IMGLINK' . $int_count . '}','singlePicturePage.php?image_id=' . $value['image_id']); 
            $parse->set_tpl('{TUMBLINK' . $int_count . '}','../img/tumbs/' . $value['file_name']); 
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


function displayMainDocument($page_no){
    $parse = new parse_class;
    prepareTemplate($parse, $page_no, TEMPLATES_DIR . '/galeryPage.tpl');
    $parse->tpl_parse(); //Парсим
    print $parse->template; //Выводим нашу страничку
}

function displayGallerySection($page_no){
    $parse = new parse_class;
    prepareTemplate($parse, $page_no, TEMPLATES_DIR . '/sectionGallery.tpl');
    $parse->tpl_parse(); //Парсим
    print $parse->template; //Выводим нашу страничку
}

function returnSinglePictureDocByID($image_id, $parse){
    $image_id = checkParam($image_id);
    executeSQL("UPDATE images SET requests_count = requests_count + 1 WHERE image_id={$image_id}");
    $res = selectAll("SELECT file_name, requests_count FROM images WHERE image_id={$image_id}");
    $parse->get_tpl(TEMPLATES_DIR . "/singleImage.tpl");
    $parse->set_tpl('{PICNAME}', $res[0]["file_name"]); 
    $parse->set_tpl('{PATHTOIMG}', "../img/" . $res[0]["file_name"]); 
    $parse->set_tpl('{ALT}', $res[0]["file_name"]); 
    $parse->set_tpl('{VIEWCOUNT}', $res[0]["requests_count"]);
    $parse->set_tpl('{image_id}', $image_id);
    $parse->tpl_parse();
    print $parse->template;
}

function addToDatabase($filename){
    $filename = checkParam($filename);
    $res = executeSQL("INSERT INTO images (`file_name`) VALUES ('{$filename}')");
}

function deleteImageById($image_id){
    $image_id = checkParam($image_id);
    $arFileList = getFilesArraySQL($image_id);
    foreach ($arFileList as &$value) {
        if(deleteFile(PICS_DIR . '/' . $value['file_name'])){
            deleteFile(TUMBS_DIR . '/' . $value['file_name']);
            executeSQL("DELETE FROM images WHERE image_id={$image_id}");
        }
    }
    unset($value);

    
}