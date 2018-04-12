<?php   

function isAuthenticated(){
    session_start();
    $flag = false;
    if(isset($_SESSION['authorized'])){
        $flag = $_SESSION['authorized'];
    }
    return $flag;
}

function checkUser($login, $password){
    require_once ENGINE_DIR . "/mySQL.php";
    $login = checkParam($login);
    $password = checkParam($password);
    if($user = selectOne("SELECT * FROM users WHERE login = '{$login}' AND password = '{$password}'")){
        session_start();
        $_SESSION['authorized'] = true;
        $_SESSION['login'] = $login;
        $_SESSION['userid'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['last_login'] = $user['last_login'];
        $date = date('c');
        executeSQL("UPDATE users SET last_login = '{$date}' WHERE id={$user['id']}");
        return true;
    }else{
        return false;
    }
}

function closeSession(){
    session_start();
    //$_SESSION['authorized']=false;
    //$_SESSION['cart_list'] = [];
    session_destroy();
}

?>