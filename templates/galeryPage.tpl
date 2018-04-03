<!DOCTYPE html>
<html lang="en">

<head>
    <title>My gallery</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <header>
        <div class="header">My gallery</div>
    </header>
    <main>
        <div class="nav" id="prev" page_no="{PREVPAGE}">&lt;&lt;</div>
        <div class="gallery" id="galery_section">
            <p>Галерея загружается...</p>        
       </div>
        <div class="nav" id="next" page_no="{NEXTPAGE}">&gt;&gt;</div>
    </main>
    <div>
        <form action="index.php" enctype="multipart/form-data" method="post">
            <input type="file" name='photo' accept=".jpg, .jpeg, .png">
            <input type="submit">
        </form>
    </div>
    <script src="./js/interface.js"></script>
</body>

</html>
