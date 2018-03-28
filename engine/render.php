<?php

function prepareTemplate($parse, $page_no, $templ_path){
    $parse->get_tpl($templ_path);
    $max_pics = 6;
    $start_img = ($page_no == 0) ? 0 : $page_no * $max_pics - $max_pics;
    $arFileList = glob(PICS_DIR . "/*.jpg" , GLOB_NOSORT);
    $arFileList = str_replace (PICS_DIR . '/' , '' , $arFileList);
    $count = 0;
    $int_count = 0;
    foreach ($arFileList as &$value) {
        if($start_img<=$count && ($start_img+$max_pics)>$count){
            $int_count++;
            $parse->set_tpl('{IMGLINK' . $int_count . '}','./img/' . $value); 
            $parse->set_tpl('{TUMBLINK' . $int_count . '}','./img/tumbs/' . $value); 
            $parse->set_tpl('{ALT' . $int_count . '}', $value);            
            
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

