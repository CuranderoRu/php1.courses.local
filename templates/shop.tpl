<!DOCTYPE html>
<html lang="en">

<head>
    <title>Megashop</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/shop.css">
</head>

<body>
    <div class="header"><a href="index.php">My shop</a></div>
    <nav>
        <ul class="main_menu">
            <li><a href="index.php">Главная</a></li>
            <li><a href="?action=viewsection&section_type=gallery">Галерея</a></li>
            <li><a href="?action=viewsection&section_type=calc">Калькулятор</a></li>
            <li class="cart_button"><a href="?action=viewsection&section_type=cart">Корзина (0)</a>
                <div class="cart_menu" id="cart_menu">
                   {cart_menu_items}
                </div>
            </li>
            <li><a href="?action=viewsection&section_type=admin">Админка</a></li>
        </ul>
    </nav>
    <div class="container">
        <ul class="categories">
            {shopcategories}
        </ul>
        <div class="items_area">
            {shopitems}
        </div>
    </div>
</body>

</html>
