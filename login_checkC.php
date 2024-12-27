<?php
include 'configdb.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // แฮชรหัสผ่านด้วย sha512
   // $hashed_password = hash('sha512', $password);

    // ป้องกัน SQL Injection โดยใช้การเตรียมคำสั่ง (prepared statements)
    $stmt = $conn->prepare("SELECT * FROM tb_customer WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบผลลัพธ์
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['cus_username'] = $row['username'];
        $_SESSION['cus_password'] = $row['password'];
        $_SESSION['cus_userid'] = $row['id'];
        $_SESSION['cus_firstname'] = $row['firstname'];
        $_SESSION['cus_lastname'] = $row['lastname'];
        $_SESSION['cus_address'] = $row['address'];
        $_SESSION['cus_tel'] = $row['telephone'];
        $_SESSION['Error'] = "";
        header("location:index.php");
    } else {
        // กรณีบัญชีหรือรหัสผ่านไม่ถูกต้อง
        $_SESSION["Error"] = "<p>Your account or password is invalid</p>";
        header("Location: login.php");
        exit();
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
}
?>
