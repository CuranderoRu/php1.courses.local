<?php

function displayMainDocument($parse, $page_no){
    //echo "Page {$page_no} requested";
    $parse->get_tpl(TEMPLATES_DIR . '/mainpage.tpl'); //Файл который мы будем парсить
    $parse->set_tpl('{PREVPAGE}','0');
    $parse->set_tpl('{IMGLINK1}','./img/fox-1.jpg');
    $parse->set_tpl('{TUMBLINK1}','./img/tumbs/fox-1.jpg');
    $parse->set_tpl('{IMGLINK2}','./img/fox-2.jpg');
    $parse->set_tpl('{TUMBLINK2}','./img/tumbs/fox-2.jpg');
    $parse->set_tpl('{IMGLINK3}','./img/fox-3.jpg');
    $parse->set_tpl('{TUMBLINK3}','./img/tumbs/fox-3.jpg');
    $parse->set_tpl('{IMGLINK4}','./img/fox-4.jpg');
    $parse->set_tpl('{TUMBLINK4}','./img/tumbs/fox-4.jpg');
    $parse->set_tpl('{IMGLINK5}','./img/fox-5.jpg');
    $parse->set_tpl('{TUMBLINK5}','./img/tumbs/fox-5.jpg');
    $parse->set_tpl('{IMGLINK6}','./img/fox-6.jpg');
    $parse->set_tpl('{TUMBLINK6}','./img/tumbs/fox-6.jpg');
    $parse->set_tpl('{NEXTPAGE}','1');
    $parse->tpl_parse(); //Парсим
    print $parse->template; //Выводим нашу страничку
}

function displayGallerySection($parse, $page_no){
    //echo "Page {$page_no} requested";
    $parse->get_tpl(TEMPLATES_DIR . '/sectionGallery.tpl'); //Файл который мы будем парсить
    $parse->set_tpl('{PREVPAGE}','1');
    $parse->set_tpl('{IMGLINK1}','./img/fox-1.jpg');
    $parse->set_tpl('{TUMBLINK1}','./img/tumbs/fox-1.jpg');
    $parse->set_tpl('{IMGLINK2}','./img/fox-2.jpg');
    $parse->set_tpl('{TUMBLINK2}','./img/tumbs/fox-2.jpg');
    $parse->set_tpl('{IMGLINK3}','./img/fox-3.jpg');
    $parse->set_tpl('{TUMBLINK3}','./img/tumbs/fox-3.jpg');
    $parse->set_tpl('{IMGLINK4}','./img/fox-4.jpg');
    $parse->set_tpl('{TUMBLINK4}','./img/tumbs/fox-4.jpg');
    $parse->set_tpl('{IMGLINK5}','./img/fox-5.jpg');
    $parse->set_tpl('{TUMBLINK5}','./img/tumbs/fox-5.jpg');
    $parse->set_tpl('{IMGLINK6}','./img/fox-7.jpg');
    $parse->set_tpl('{TUMBLINK6}','./img/tumbs/fox-7.jpg');
    $parse->set_tpl('{NEXTPAGE}','0');
    $parse->tpl_parse(); //Парсим
    print $parse->template; //Выводим нашу страничку
}
