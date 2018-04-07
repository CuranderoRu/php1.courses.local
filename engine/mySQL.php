<?php

function get_connection(){
    static $conn;
    if($conn==null){
        $conn = mysqli_connect(MYSQL_ADDRESS, MYSQL_LOGIN, MYSQL_PSW, MYSQL_DBNAME);
    }
    return $conn;
}

function checkParam($param){
    return mysqli_real_escape_string(get_connection(), $param);
}

function executeSQL($stmt){
    //echo $stmt . '<br>';
    return mysqli_query(get_connection(), $stmt);
}

function selectAll($sql){
    $res = executeSQL($sql);
    //var_dump($res);
    if(count($res)>0){
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }else{
        return [];
    }
    
}

function selectOne($sql){
    //echo $sql;
    $res = executeSQL($sql);
    return mysqli_fetch_array($res, MYSQLI_ASSOC);
}


?>
