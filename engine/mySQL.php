<?php

function query($sql,$conn,$fetch=true){
    $res = mysqli_query($conn, $sql);
    if($fetch==true){
        $return = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }else{
        if($res == false){
            var_dump($sql);
        }
        $return = $res;
    }
    
    return $return;
}

?>