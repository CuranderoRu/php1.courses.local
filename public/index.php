<?php
header('Content-Type: text/html;charset=utf-8');
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
include_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once TEMPLATES_DIR . "/template.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/handler.php";

//prepareTemplate($parse, 2, TEMPLATES_DIR . '/mainpage.tpl');

displayMainDocument($parse, 1);

?>