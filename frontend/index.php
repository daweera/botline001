<!--เขียน HTML--->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line User</title>
    <link rel="stylesheet" href="style.css">
    <!--   เรียกใช้ bootstrap ออนไลน์ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
            <div class="container">
                    <ul class="navbar-nav">
                        <a class="navbar-brand" href="index.php">BotLine</a>
                        <li class="nav-item">
                            <a class="nav-link" href="indexuserr.php">โปรไฟล์ไลน์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="indexgroupline.php">กรุ๊ปไลน์</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav" style="float:right;">
                        <li class="nav-item nav-link" >
                            ยินดีต้อนรับ<?php //echo $row['firstname'] . ' ' . $row['lastname'] ?>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn btn-outline-danger" type="button" onclick="window.location.href='#'">ออกจากระบบ</button>
                        </li>
                    </ul>
            </div>
        </nav>
    <div class="container">
        <h2 class="mt-4">ยินดีต้อนรับ</h2>
    </div>
</body>
</html>