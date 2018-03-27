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
            <a href="{IMGLINK1}" target="_blank"><img src="{TUMBLINK1}" alt="fox-1"></a>
            <a href="{IMGLINK2}" target="_blank"><img src="{TUMBLINK2}" alt="fox-2"></a>
            <a href="{IMGLINK3}" target="_blank"><img src="{TUMBLINK3}" alt="fox-3"></a>
            <a href="{IMGLINK4}" target="_blank"><img src="{TUMBLINK4}" alt="fox-4"></a>
            <a href="{IMGLINK5}" target="_blank"><img src="{TUMBLINK5}" alt="fox-5"></a>
            <a href="{IMGLINK6}" target="_blank"><img src="{TUMBLINK6}" alt="fox-6"></a>
        </div>
        <div class="nav" id="next" page_no="{NEXTPAGE}">&gt;&gt;</div>
    </main>
    <script src="./js/interface.js"></script>
</body>
</html>