<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login page</title>
</head>

<body>
    <p><?=$message?></p>
    <h1>Пожалуйста, войдите в магазин:</h1>
    <form action="?action=processlogin" method="post">
        <p><b>Логин:</b><br>
            <input type="text" name="login" size="25">
        </p>
        <p><b>Пароль:</b><br>
            <input type="text" name="password" size="25">
        </p>
        <input type="hidden" name="redirect_arg" value="<?=$redirect?>">
        <button type="submit">Login</button>
    </form>
</body>

</html>
