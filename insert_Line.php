<?php
session_start();
if (isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sToken = "LGsbe2CpVUrn3L4jTKyFEfWYdFdQ3Wjb06B9ZkWhGkC";
    $sMessage = "ມີລາຍງານການສັ່ງເຂົ້າ\n....";
    $sMessage .= "ຊື່ " . $pname . "\n";
    $sMessage .= "E-mail " . $email . "\n";
    $sMessage .= "Address: " . $address . "\n";  // เพิ่มที่อยู่ลงในข้อความ

    $chOne = curl_init(); 

    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($chOne, CURLOPT_POST, 1); 
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage); 

    $headers = array( 
        'Content-type: application/x-www-form-urlencoded', 
        'Authorization: Bearer ' . $sToken 
    );
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1); 

    $result = curl_exec($chOne); 

    // Result error 
    if (curl_error($chOne)) { 
        $_SESSION['error'] = "ບໍ່ສາມາດສົ່ງຂໍ້ມູນການແຈ້ງເຕືອນ LINE Notify ໄດ້"; 
    } else { 
        $result_ = json_decode($result, true); 
        if ($result_) {
            $_SESSION['success'] = "ສົ່ງຂໍ້ມູນການແຈ້ງເຕືອນ LINE Notify ແລ້ວ";
        } else {
            $_SESSION['error'] = "ບໍ່ສາມາດສົ່ງຂໍ້ມູນການແຈ້ງເຕືອນ LINE Notify ໄດ້"; 
        }
    }

    curl_close($chOne);   
    header("Location: fr_user_Notfy.php");
    exit; // หยุดการทำงานของสคริปต์หลังจาก redirect
}
?>
