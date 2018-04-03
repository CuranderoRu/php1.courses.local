<!DOCTYPE html>
<html lang="en">
<head>
    <title>Megashop</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/shop.css">
</head>

<body>
    <div class="header"><a href="index.php">My shop</a></div>
    <div class="container">
        <div>
            <div class="item_capture">{item_descr}</div>
            <img src="/img/{item_img}" alt="{item_img}">
            <div>{item_comment}</div>
            <div class="item_price">Цена: {item_price}</div>
            <div class="comments">
                <form action="?action=addcomment&item_id={item_id}" method="post">
                    <p><b>Ваше имя:</b><br>
                        <input type="text" name="author" size="25">
                    </p>
                    <p><b>Комментарий:</b><br>
                        <textarea name="comment"></textarea>
                    </p>
                    <button type="submit">Отправить</button>
                </form>
                <br>
                Комментарии покупателей:
                {COMMENTS}
            </div>

        </div>
    </div>
</body>
</html>