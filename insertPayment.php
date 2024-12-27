<?php
include 'configdb.php';

$orderID = $_POST['orderID'];
$pay_money = $_POST['pay_money'];
$payDate = $_POST['pay_date'];
$pay_time = $_POST['pay_time'];
$img = ""; // กำหนดค่าเริ่มต้นของภาพ

// เปิดการแสดงข้อผิดพลาด
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ตรวจสอบว่าค่า orderID เป็นตัวเลขหรือไม่
if (empty($orderID) || !is_numeric($orderID)) {
    echo "<script>
        alert('ກະລຸນາປ້ອນລະຫັດ orderID ທີ່ຖືກຕ້ອງ');
        window.history.back();
    </script>";
    exit();
}

// ตรวจสอบว่ามีการทำรายการสำหรับ orderID นี้ไปแล้วหรือยัง
$check_sql = "SELECT * FROM payment WHERE orderID = '$orderID'";
$result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($result) > 0) {
    // หากพบว่ามีรายการอยู่แล้ว จะแจ้งเตือนผู้ใช้
    echo "<script>
        alert('ມີການທຳລາຍການນີ້ແລ້ວກະລຸນາກວດສອບ');
        window.history.back();
    </script>";
    exit();
}

// ตรวจสอบว่ามีการอัปโหลดภาพหรือไม่
if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
    $check_image = getimagesize($_FILES['image']['tmp_name']);
    if ($check_image === false) {
        echo "<script>
            alert('ກະລຸນາອັບໂຫຼດຮູບພາບທີ່ຖືກຕ້ອງ');
            window.history.back();
        </script>";
        exit();
    }
    
    // สร้างชื่อไฟล์ใหม่แบบไม่ซ้ำ
    $target_dir = "./Img/payment/";  
    $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $new_image_name = uniqid() . 'b_' . uniqid() . "." . $imageFileType;
    $image_upload_path = $target_dir . $new_image_name;

    // ย้ายไฟล์ที่อัปโหลด
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_upload_path)) {
        $img = $new_image_name; // ใช้ชื่อไฟล์ที่ถูกสร้างใหม่
    } else {
        echo "<script>
            alert('ມີບາງຢ່າງຜິດພາດໃນການອັບໂຫຼດຮູບພາບ');
            window.history.back();
        </script>";
        exit();
    }
}




// คำสั่ง SQL สำหรับเพิ่มข้อมูลการชำระเงิน
$sql = "INSERT INTO payment (orderID, pay_money, pay_date, pay_time, pay_image) 
        VALUES ('$orderID', '$pay_money', '$payDate', '$pay_time', '$img')";


$hand = mysqli_query($conn, $sql);
if ($hand) {
   echo "<script>
            alert('ບັນທຶກຂໍ້ມູນສຳເລັດ');
            window.location='pay_ment.php';
        </script>";
} else {
    echo "<script>
        alert('ມີບາງຢ່າງຜິດພາດໃນການບັນທຶກຂໍ້ມູນ');
        window.history.back();
    </script>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
exit();
?>
