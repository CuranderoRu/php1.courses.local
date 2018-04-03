<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{PICNAME}</title>
</head>
<body>
    <img src="{PATHTOIMG}" alt="{ALT}">
    <div>Количество просмотров - {VIEWCOUNT}</div>
    <form action="index.php?action=deleteimage" enctype="multipart/form-data" method="post">
           <button name="image_id" value = {image_id}>Удалить</button>
    </form>

</body>
</html>