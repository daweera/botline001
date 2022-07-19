<?php 
// เรียกใช้ session
session_start();
// เชื่อมต่อฐานข้อมูล
require_once 'db.php';
// ดึงข้อมูลที่ต้องการมาแสดงไว้ที่ตาราง

?>
<!--เขียน HTML--->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line user</title>
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
                            <button class="btn btn btn-outline-danger" type="button" onclick="window.location.href='#'">ออกจากระบบ</a>
                        </li>
                    </ul>
            </div>
        </nav>
    <div class="container">
        <h1 class="mt-4 fs-1">ข้อมูลผู้ใช้</h1>
        <table class="table table-striped table-bordered table-hover text-center table-responsive mt-4">
            <thead>
                <tr>
                    <th>userid</th>
                    <th>username </th>
                    <!-- <th>urlpicture </th> -->
                    <th>grouplineID </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $select_stmt = $conn->prepare("SELECT * FROM userr"); //ดึงข้อมูลทั้งหมดจากตาราง 'groupline'
                    $select_stmt->execute();//เรียกใช้คำสั่ง sql ด้านบน เพื่อดึงข้อมูลที่ต้องการ

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)): //ตราบใดที่ยังมีข้อมูลอยู่ในตาราง
                ?>
                    <tr>
                        <td><?php echo $row['userid']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <!-- <td><?php //echo $row['urlpicture']; ?></td> -->
                        <td><?php echo $row['grouplineID']; ?></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</body>
</html>