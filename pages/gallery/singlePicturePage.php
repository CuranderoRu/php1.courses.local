<?php
require_once ENGINE_DIR . "/files.php";
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/gallery.php";

returnSinglePictureDocByID($_GET['image_id'], $parse);

?>
