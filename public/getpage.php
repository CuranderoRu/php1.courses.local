<?php
header('Content-Type: text/html;charset=utf-8');
header('Access-Control-Allow-Origin: *');
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
include_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once TEMPLATES_DIR . "/template.php";

$page_no = $_GET['page_no'];
displayGallerySection($parse, $page_no);
?>