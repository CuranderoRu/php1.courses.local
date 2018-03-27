<?php
header('Content-Type: text/html;charset=utf-8');
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
include_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once TEMPLATES_DIR . "/template.php";
require_once ENGINE_DIR . "/render.php";


displayMainDocument($parse, 1);

/*
var_dump ($_SERVER);


$dir = opendir(".");
while($file = readdir($dir)){
    if(is_dir($file)){
        echo "<strong>$file</strong><br>";
    }else{
        echo "$file<br>";
    }
}
closedir($dir);

var_dump(scandir("."));

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_FILES['file'])){
        $tmp = $_FILES['file']['tmp_name'];
        $filePath = UPLOADS_DIR . "/". $_FILES['file']['name'];
        move_uploaded_file($tmp, $filePath);
    }
}

extract(['var' => 1]);

*/
?>