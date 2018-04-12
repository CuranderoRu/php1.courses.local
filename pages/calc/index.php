<?php
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/calc.php";

if(isset($_GET['action'])){
    evalCalcForm();
}else{
    displayCalc();
}

?>
