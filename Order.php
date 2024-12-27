<?php
ob_start();
session_start();
include('configdb.php');

if(!isset($_SESSION["inTLine"]))
{
    // session not yet started, create an empty array to store items in cart
    $_SESSION["inTLine"] = 0;
    $_SESSION["strProductID"][0] = $_GET["id"];
    $_SESSION["strQty"][0] = 1;
} else {
    $key = array_search($_GET["id"], $_SESSION["strProductID"]);
    if ($key !== false) {
        // ถ้าสินค้าอยู่แล้ว เพิ่มจำนวน
        $_SESSION["strQty"][$key] += 1;
    } else {
        // เพิ่มสินค้าใหม่ใน session
        $_SESSION["inTLine"] += 1; // เพิ่มจำนวนบรรทัด
        $intNewLine = $_SESSION["inTLine"];
        $_SESSION["strProductID"][$intNewLine] = $_GET["id"];
        $_SESSION["strQty"][$intNewLine] = 1;
    }
}
header("location:cart.php");
exit; // ควร exit หลังจาก header เพื่อหยุดการประมวลผล
?>
