<?php
ob_start(); // เริ่มการบัฟเฟอร์เอาต์พุต
session_start(); // เริ่ม session
include('configdb.php'); // รวมไฟล์การเชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการเริ่ม session หรือไม่
if(!isset($_SESSION["inTLine"])){
    // หาก session ยังไม่เริ่ม, สร้าง array เปล่าสำหรับเก็บข้อมูลในตะกร้า
    $_SESSION["inTLine"] = 0; // เริ่มต้นจำนวนรายการในตะกร้าเป็น 0
    $_SESSION["strProductID"][0] = $_GET["id"]; // เพิ่ม ID สินค้าแรกเข้าไป
    $_SESSION["strQty"][0] = 1; // จำนวนสินค้าคือ 1
} else {
    // ค้นหาว่าสินค้าที่ต้องการเพิ่มอยู่ในตะกร้าหรือไม่
    $key = array_search($_GET["id"], $_SESSION["strProductID"]);
    if ($key !== false) {
        // ถ้าสินค้าอยู่แล้ว, ลดจำนวนสินค้าในตะกร้า
        $_SESSION["strQty"][$key] -= 1; // ลดจำนวนสินค้า
        
        
    } else {
        // หากสินค้าไม่อยู่ในตะกร้า, เพิ่มสินค้าใหม่ใน session
        $_SESSION["inTLine"] += 1; // เพิ่มจำนวนบรรทัด
        $intNewLine = $_SESSION["inTLine"]; // รับค่าบรรทัดใหม่
        $_SESSION["strProductID"][$intNewLine] = $_GET["id"]; // เพิ่ม ID สินค้าใหม่
        $_SESSION["strQty"][$intNewLine] = 1; // กำหนดจำนวนสินค้าเป็น 1
    }
}
header("location:cart.php"); // เปลี่ยนเส้นทางไปที่ cart.php
exit; // หยุดการประมวลผล
?>
