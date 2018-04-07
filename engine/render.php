<?php

function render($template, $params = [], $useLayout = true){
    $content = renderTemplate($template, $params);
    if($useLayout){
        $content= renderTemplate('layouts/main', ['content' => $content]);
    }
    return $content;
}


function renderTemplate($template, $params = []){
    ob_start();
    extract($params);
    include TEMPLATES_DIR . "/{$template}.tpl";
    return ob_get_clean();
}

function renderTpl($template, $params = [], $parse){
    $parse->get_tpl(TEMPLATES_DIR . "/" . $template);
    foreach($params as $key => $value) 
    { 
        $parse->set_tpl($key,$value);
    } 
    $parse->tpl_parse();
    return $parse->template;
}