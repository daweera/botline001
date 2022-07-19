<?php
// เรียกใช้ session
session_start();
// เชื่อมต่อฐานข้อมูล
require_once 'db.php';

if (isset($_REQUEST['delete_id'])) { //ถ้ามีการกดปุ่ม delete
    $grouplineID = $_REQUEST['delete_id']; //$_REQUEST['delete_id'] คือ $row["id"]

    $select_stmt = $conn->prepare("SELECT * FROM groupline WHERE grouplineID = :grouplineID"); //เลือกทุกแถว จากตาราง 'groupline' โดยที่ ข้อมูลในคอลัมน์ไอดี ตรงกับตัวแปรไอดี
    $select_stmt->bindParam(':grouplineID', $grouplineID); //ผูกตัวแปร $id
    $select_stmt->execute();//เรียกใช้คำสั่ง sql ด้านบน เพื่อดึงข้อมูลที่ต้องการ
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC); //ดึงข้อมูลทั้งหมดในแถวที่ ข้อมูลในคอลัมน์ไอดี ตรงกับตัวแปรไอดี มาเก็บไว้ในตัวแปร $row

    // Delete an original record from db
    $delete_stmt = $conn->prepare('DELETE FROM groupline WHERE grouplineID = :grouplineID'); //ลบข้อมูลทุกแถว ในตาราง 'groupline' โดยที่ ข้อมูลในคอลัมน์ไอดี ตรงกับตัวแปรไอดี
    $delete_stmt->bindParam(':grouplineID', $grouplineID); //ผูกตัวแปร $id
    $delete_stmt->execute();//เรียกใช้คำสั่ง sql ด้านบน เพื่อลบข้อมูลที่ต้องการ

    header('refresh:1; indexgroupline.php'); //อยู่ในหน้า indexgroupline.php เหมือนเดิม
}
?>
<!--เขียน HTML--->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line users</title>
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
         <p class="mt-4 fs-1">ข้อมูลกลุ่มไลน์ <!-- <a href="#" class="btn btn-success mb-3 mx-5">Add+</a> --></p> 
        <table class="table table-striped table-bordered table-hover text-center table-responsive mt-4">
            <thead>
                <tr>
                    <th width="20%">grouplineid</th>
                    <th width="20%">groupname </th>
                    <!-- <th>urlpicturegroup </th> -->
                    <th width="20%">Token Notify</th>
                    <th >แก้ไขข้อมูล</th>
                    <th >Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $select_stmt = $conn->prepare("SELECT * FROM groupline"); //ดึงข้อมูลทั้งหมดจากตาราง 'groupline'
                    $select_stmt->execute();//เรียกใช้คำสั่ง sql ด้านบน เพื่อดึงข้อมูลที่ต้องการ

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)): //ตราบใดที่ยังมีข้อมูลอยู่ในตาราง
                ?>
                    <tr>
                        <td><?php echo $row['grouplineID']; ?></td>
                        <td><?php echo $row['groupname']; ?></td>
                        <!-- <td><?php //echo $row['urlpicturegroup']; ?></td> -->
                        <td><?php echo $row["TokenNotify"]; //แสดงข้อมูลในคอลัมน์ TokenNotify?></td>
                        <td><a href="edit.php?update_id=<?php echo $row['grouplineID'];?>" class="btn btn-warning">Edit</a></td> <!-- แก้ไขข้อมูล -->
                        <td><a href="?delete_id=<?php echo $row['grouplineID'];?>" class="btn btn-danger">Delete</a></td> <!-- ลบข้อมูล -->
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</body>
</html>