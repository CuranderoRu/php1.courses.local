<?php

function displayCalc($parse){
    $parse->get_tpl(TEMPLATES_DIR . "/calc.tpl");
    $parse->set_tpl('{OP1}',0); 
    $parse->set_tpl('{OP2}', 0);
    $parse->set_tpl('{RESULT}', 0);
    $parse->tpl_parse();
    print $parse->template;
}

function evaluateOperands($op1, $op2, $a){
    $res = 0;
    switch ($a)
    {
        case "+":
            $res = $op1 + $op2;
            break;
        case "-":
            $res = $op1 - $op2;
            break;
        case "/":
            $res = ($op2 <> 0) ? ($op1 / $op2) : "Деление на ноль";
            break;
        case "*":
            $res = $op1 * $op2;
            break;
        default:
            $res = "Некорректное значение оператора";
    }
    return $res;
}

function defineSelected($a){
    $res = array('','','','');
    switch ($a)
    {
        case "+":
            $res[0]='selected';
            break;
        case "-":
            $res[1]='selected';
            break;
        case "*":
            $res[2]='selected';
            break;
        case "/":
            $res[3]='selected';
            break;
    }
    return $res;
}

function evalCalcForm($parse){
    $op1 = (float) str_replace ( ',' , '.' , $_POST['operand1']);
    $op2 = (float) str_replace ( ',' , '.' , $_POST['operand2']);
    $a = $_POST['operator'];
    $sel = defineSelected($a);
    $res = evaluateOperands($op1, $op2, $a);
    $parse->get_tpl(TEMPLATES_DIR . "/calc.tpl");
    $parse->set_tpl('{OP1}',$op1); 
    $parse->set_tpl('{OP2}', $op2);
    $parse->set_tpl('{SELECTED_VALUE0}', $sel[0]);
    $parse->set_tpl('{SELECTED_VALUE1}', $sel[1]);
    $parse->set_tpl('{SELECTED_VALUE2}', $sel[2]);
    $parse->set_tpl('{SELECTED_VALUE3}', $sel[3]);
    $parse->set_tpl('{RESULT}', $res);
    $parse->tpl_parse();
    print $parse->template;

}

?>