<?php
session_start();
include 'configdb.php';
//display error message
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ຮັບຂໍ້ມູນຈາກຟອມ
    $cusName = $_POST['cus_name'];
    $cusAddress = $_POST['cus_add'];
    $cusTel = $_POST['cus_tel'];
    $dmonth = date("F"); // ເກັບຊື່ເດືອນໃນຮູບແບບທີ່ຕ້ອງການ
    $cusID = $_SESSION["cus_userid"];

    // ກວດສອບວ່າຂໍ້ມູນບໍ່ຫວ່າງ
    if (empty($cusName)) {
        echo "<script>alert('ກະລຸນາໃສ່ຂໍ້ມູນທີ່ຈໍາເປັນ.'); window.history.back();</script>";
        exit; // ຢຸດການປະມວນຜົນ
    }

    // ກວດສອບຄ່າທີ່ສົ່ງໃນ session
    if (!isset($_SESSION["strProductID"], $_SESSION["strQty"], $_SESSION["sum_Price"], $_SESSION["inTLine"])) {
        echo "<script>alert('ບໍ່ມີສິນຄ້າໃນຕະກ້າ'); window.history.back();</script>";
        exit;
    }

    // ບັນທຶກຂໍ້ມູນໃນຕາຕະລາງ tb_order
    $sql = "INSERT INTO tb_order (cus_id, cus_name, address, telephone, total_price, order_status, dateMonth)
            VALUES ('$cusID', '$cusName', '$cusAddress', '$cusTel', '{$_SESSION["sum_Price"]}', 1, '$dmonth')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting order: " . mysqli_error($conn);
        exit;
    }

    $orderID = mysqli_insert_id($conn); // ຮັບ orderID ຫລັງຈາກ insert ສຳເລັດແລ້ວ
    $_SESSION["order_id"] = $orderID;

    // ບັນທຶກຂໍ້ມູນໃນ tb_order_detail
    for ($i = 0; $i < (int)$_SESSION["inTLine"]; $i++) {
        if (!empty($_SESSION["strProductID"][$i])) {
            $sql1 = "SELECT * FROM product WHERE pro_id='{$_SESSION["strProductID"][$i]}'";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $price = $row1['price'];
            $total = $_SESSION['strQty'][$i] * $price;

            // ບັນທຶກຂໍ້ມູນໃນ tb_order_detail
            $sql2 = "INSERT INTO order_detail(orderID, pro_id, OrderPrice, OrderQty, Total)
                     VALUES ('$orderID', '{$_SESSION["strProductID"][$i]}', '$price', '{$_SESSION["strQty"][$i]}', '$total')";

            if (mysqli_query($conn, $sql2)) {
                // ປັບປຸງສະຕ໋ອກສິນຄ້າ
                $sql3 = "UPDATE product SET amount = amount - '{$_SESSION["strQty"][$i]}' WHERE pro_id='{$_SESSION['strProductID'][$i]}'";

                if (!mysqli_query($conn, $sql3)) {
                    echo "Error updating stock: " . mysqli_error($conn);
                }
            } else {
                echo "Error inserting order detail: " . mysqli_error($conn);
            }
        }
    }

    // ກວດສອບວ່າມີສິນຄ້າໃດຫມົດສະຕ໋ອກບໍ່
    $out_of_stock_products = [];
    foreach ($_SESSION["strProductID"] as $pro_id) {
        $sql3 = "SELECT amount FROM product WHERE pro_id='$pro_id'";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        if ($row3['amount'] < 1) {
            $out_of_stock_products[] = $pro_id;
        }
    }

    if (count($out_of_stock_products) > 0) {
        $out_of_stock_msg = "ສິນຄ້າດັ່ງຕໍ່ໄປນີ້ໃນຕະກ້າຂອງທ່ານໄດ້ຫມົດສະຕ໋ອກຢູ່ຕອນນີ້:\n\n";
        foreach ($out_of_stock_products as $pro_id) {
            $sql4 = "SELECT pro_name FROM product WHERE pro_id='$pro_id'";
            $result4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($result4);
            $out_of_stock_msg .= "- " . $row4['pro_name'] . "\n";
        }
        $out_of_stock_msg .= "\nກະລຸນາລົບຫລືປັບປຸງຈຳນວນສິນຄ້າເຫລົ່ານີ້ແລ້ວລອງໃຫມ່.";

        $_SESSION['out_of_stock'] = true;
        $_SESSION['out_of_stock_msg'] = $out_of_stock_msg;

        echo "<script>alert('" . $out_of_stock_msg . "'); window.location='cart.php';</script>";
    } else {
        echo "<script> window.location='print_order.php';</script>";
    }

    //-------------ແຈ້ງເຕືອນທາງ LINE Notify
    date_default_timezone_set("Asia/Bangkok");
    $date = date("d-m-Y");

    $sToken = "eU4ncBqutSILneoIfTCc4mewtUJePsn0LVtCvQPtBbm";
    $sMessage = "ມີການສັ່ງຊື້ສິນຄ້າເຂົ້າມາ\n";
    $sMessage .= "ວັນທີ່ " . $date . "\n";
    $sMessage .= "ຊື່ລູກຄ້າ " . $cusName . "\n";
    $sMessage .= "ໃບສັ່ງຊື້ສິນຄ້າ " . $_SESSION["order_id"] . "\n";
    $sMessage .= "ເບີໂທລະສັບ " . $cusTel . "\n";

    $chOne = curl_init(); 
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($chOne, CURLOPT_POST, 1); 
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage); 
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken,);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec($chOne); 

    if (curl_error($chOne)) { 
        echo 'Error:' . curl_error($chOne); 
    } else { 
        $result_ = json_decode($result, true); 
    } 
    curl_close($chOne);

    // ລ້າງ session
    unset($_SESSION["strProductID"], $_SESSION["strQty"], $_SESSION["sum_Price"], $_SESSION["inTLine"]);

}
?>
