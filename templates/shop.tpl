<!DOCTYPE html>
<html lang="en">

<head>
    <title>Megashop</title>
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/shop.css">
</head>

<body>
    <div class="header"><a href="index.php">My shop</a></div>
    <nav>
        <ul class="main_menu">
            <li><a href="..">Главная</a></li>
            <li><a href="../gallery/index.php">Галерея</a></li>
            <li><a href="../calc/index.php">Калькулятор</a></li>
            <li class="cart_button"><a href="/shop/cart.php">Корзина (0)</a>
                <div class="cart_menu" id="cart_menu">
                   {cart_menu_items}
                </div>
            </li>
            <li><a href="/shop/admin.php">Админка</a></li>
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
