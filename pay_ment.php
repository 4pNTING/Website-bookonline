<?php
include 'configdb.php';
session_start();
$orderID = "";
$cusname = "";
$orderStatus = "";  // ต้องตั้งค่าให้ว่างเปล่าหากยังไม่ได้รับข้อมูล
$total_price = 0;

if (isset($_POST['btn1'])) {
    $key_word = $_POST['keyword'];
    
    if ($key_word != "") {
        // ดึงข้อมูลตามคำค้นหา
        $sql = "SELECT * FROM tb_order WHERE orderID LIKE '$key_word'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $orderID = $row['orderID'];
            $cusname = $row['cus_name'];
            $total_price = $row['total_price'];
            $orderStatus = $row['order_status'];  // ตั้งค่าสถานะคำสั่งซื้อ
        } else {
            // ไม่พบข้อมูล
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ບໍ່ພົບຂໍ້ມູນ',
                    text: 'ຂໍ້ມູນໃບສັ່ງຊື້ທີ່ຄົ້ນຫາບໍ່ມີຢູ່!',
                });
            </script>";
            $_SESSION['error'] = "ບໍ່ພົບຂໍ້ມູນ ໃບສັ່ງຊື້ທີ່ຄົ້ນຫາບໍ່ມີຢູ່ !!";
        }
    } else {
        // ตรวจสอบผลลัพธ์ให้แน่ใจว่ามีข้อมูล
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $orderID = $row['orderID'];
            $cusname = $row['cus_name'];
            $total_price = $row['total_price'];
            $orderStatus = $row['order_status'];  // ตั้งค่าสถานะคำสั่งซื้อ
        }
    }
}
?>


<!doctype html>
<html lang="en">
    <head>
        <title>ແຈ້ງຊຳລະເງິນ</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
    </head>
    <style>
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
            font-family: 'Kanit', sans-serif;
        }
        .container {
            flex: 1;
        }
        footer {
            margin-top: auto;
        }
    </style>
    <body >
        <div class="container ">
            <?php include 'Menu.php'; ?>

            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        ແຈ້ງຂໍ້ມູນການຊຳລະເງິນ
                    </div>

                    <div class="border p-4 bg-light" style="border-radius: 10px;">
                        <form method="post" action="pay_ment.php">
                            <div class="mb-3">
                                <label for="idkeyword" class="form-label">ເລກທີ່ໃບສັ່ງຊື້</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="idkeyword" name="keyword" placeholder="Enter Order ID" required>
                                    <button type="submit" name="btn1" class="btn btn-primary ">Search</button>
                                  
                                </div>
                            </div>
                            <br>
                            <?php
                                    if(isset($_SESSION['error'])){
                                        echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
                                        unset($_SESSION['error']);
                                    }
                                    ?>
                                    <br>
                        </form>
                    </div>

                    <?php if (!empty($orderID)) { ?>
                    <div class="border p-4 my-4 bg-light" style="border-radius: 10px;">
                        <form id="paymentForm" method="POST" action="insertPayment.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="order_id" class="form-label">ເລກທີ່ໃບສັ່ງຊື້</label>
                                <input type="text" class="form-control mb-2" id="orderID" name="orderID" value="<?php echo $orderID; ?>" readonly>
                                <?php
            // แสดงสถานะการสั่งซื้อ
            if ($orderStatus == '1') {
                
                echo "<p class='text-danger'>ສະຖານະ: ຍັງບໍ່ຊຳລະເງິນ</p>";
            } elseif ($orderStatus == '2') {
                echo "<p class='text-success'>ສະຖານະ: ຊຳລະເງິນສຳເລັດ</p>";
            }
            ?>
                            </div>
                         

                            <div class="mb-3">
                                <label for="cusName" class="form-label mt-2s">ຊື່-ນາມສະກຸນ(ລູກຄ້າ)</label>
                                <input type="text" class="form-control" id="cusName" name="cusName" value="<?php echo $cusname; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="total_price" class="form-label">ຈຳນວນເງິນ</label>
                                <input type="text" class="form-control" id="pay_money" name="pay_money" value="<?php echo $total_price; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="pay_date" class="form-label">ວັນທີ່ໂອນເງິນ</label>
                                <input type="date" class="form-control" id="pay_date" name="pay_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="pay_time" class="form-label">ເວລາໂອນເງິນ</label>
                                <input type="time" class="form-control" id="pay_time" name="pay_time">
                            </div>

                            <div class="mb-3">
                                <label for="evidence" class="form-label">ຫຼັກຖານການໂອນເງິນ</label>
                                <input type="file" class="form-control" id="evidence" name="image" required>
                            </div>

                            <div class="d-grid">
                                <?php
                                if($orderStatus == '1'){
                                    ?>
                                      <button type="button" class="btn btn-primary btn-lg " name="btn2" onclick="submitForm()">Submit</button>
                                <?php }else {
                                    ?>
                                      <button type="button" class="btn btn-primary btn-lg " name="btn2" disabled onclick="submitForm()">Submit</button>
                               <?php }
                                ?>
                              
                            </div>
                        </form>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        include 'footer.php';
        ?>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- SweetAlert Script -->
        <script>
            function submitForm() {
                Swal.fire({
                    title: 'ຢືນຢັນການສົ່ງຟອມ?',
                    text: "ເຈົ້າຈະບໍ່ສາມາດແກ້ໄຂໄດ້ຫຼັງຈາກສົ່ງ!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('paymentForm').submit(); // ส่งฟอร์มหากผู้ใช้ยืนยัน
                    }
                })
            }
        </script>
 
    </body>
</html>
