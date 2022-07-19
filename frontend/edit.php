<!-- Not Yet-->
<?php
// เรียกใช้ session
session_start();
// เชื่อมต่อฐานข้อมูล
require_once 'db.php';

if (isset($_REQUEST['update_id'])) {//ถ้ามีการกดปุ่มยืนยันการแก้ไขข้อมูล
    try {
        $grouplineID = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM groupline WHERE grouplineID = :grouplineID"); //เลือกข้อมูลทุกแถว จากตาราง 'groupline' โดยที่ ข้อมูลในคอลัมน์ไอดี ตรงกับตัวแปรไอดี
        $select_stmt->bindParam(':grouplineID', $grouplineID);//ผูกตัวแปร $id
        $select_stmt->execute();//เรียกใช้คำสั่ง sql ด้านบน เพื่อดึงข้อมูลที่ต้องการ
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);//ดึงข้อมูลทั้งหมดในแถวที่ ข้อมูลในคอลัมน์ไอดี ตรงกับตัวแปรไอดี มาเก็บไว้ในตัวแปร $row
        extract($row); //เป็นการสร้างตัวแปรจาก array โดย index จะกลายเป็นชื่อตัวแปร และจะคืนค่าจำนวนของตัวแปรที่เกิดขึ้น ด้วยฟังก์ชั่น extract()
    } catch(PDOException $e) {//ถ้ามีอะไรผิดพลาด
        $e->getMessage();
    }
}

if (isset($_REQUEST['btn_update'])) {
    $TokenNotify = $_REQUEST['NewTokenNotify'];
    if (isset($TokenNotify)){
        $update_stmt = $conn->prepare("UPDATE groupline SET TokenNotify=:NewTokenNotify WHERE grouplineID = :grouplineID");
        $update_stmt->bindParam(':NewTokenNotify', $TokenNotify);
        $update_stmt->bindParam(':grouplineID', $grouplineID);
        if ($update_stmt->execute()) {
            $updateMsg = "update Successfully...";
            header("refresh:1;indexgroupline.php");
        }
    }else{
            $updateMsg = "Not Update...";
            header("refresh:1;indexgroupline.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่ม token notify</title>
    <!--   เรียกใช้ bootstrap ออนไลน์ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="display-3 text-center">Edit Page</div>

        <!-- แจ้งเตือน $errorMsg แก้ไขข้อมูลไม่สำเร็จ-->
        <?php if (isset($errorMsg)) {?>
            <div class="alert alert-danger">
                <strong>Wrong! <?php echo $errorMsg; ?></strong>
            </div>
        <?php } ?>

        <!-- แจ้งเตือน $updateMsg แก้ไขข้อมูลสำเร็จ-->
        <?php if (isset($updateMsg)) {?>
            <div class="alert alert-success">
                <strong>Success! <?php echo $updateMsg; ?></strong>
            </div>
        <?php } ?>

        <form method="post" class="form-horizontal mt-5">
                <!-- รับข้อมูล NewTokenNotify -->
                <div class="form-group text-center">
                    <div class="row">
                        <label for="NewTokenNotify" class="col-sm-3 control-label">NewTokenNotify</label>
                        <div class="col-sm-9">
                            <input type="text" name="NewTokenNotify" class="form-control" value="<?php //echo $TokenNotify; ?>">
                        </div>
                    </div>
                </div>
                <!-- ปุ่มยืนยันการแก้ไขข้อมูล -->
                <div class="form-group text-center">
                    <div class="col-md-12 mt-3">
                        <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                        <a href="indexgroupline.php" class="btn btn-danger">Cancel</a> <!-- ปุ่มยกเลิกการแก้ไขข้อมูล -->
                    </div>
                </div>
        </form>
    </div>
</body>
</html>