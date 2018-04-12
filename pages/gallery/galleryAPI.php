<?php
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/gallery.php";

$page_no = $_GET['page_no'];
displayGallerySection($page_no);


?>
