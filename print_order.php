<?php
include 'configdb.php'; // เชื่อมต่อฐานข้อมูล
session_start(); // เริ่มต้นเซสชัน

// ดึงข้อมูลการสั่งซื้อจากฐานข้อมูล
$sql = "SELECT * FROM tb_order WHERE orderID='" . $_SESSION["order_id"] . "'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);
$total_price = $rs['total_price']; // ใช้ $rs แทน $re
?>
<!doctype html>
<html lang="en">

<head>
    <title>การสั่งซื้อสินค้า</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-primary h4 mt-4 text-center" role="alert">
                   ໃບສັ່ງຊື້ສິນຄ້າລູກຄ້າ
                </div>
                <!-- แสดงข้อมูลการสั่งซื้อ -->
                <p>ເລກທີ່ການສັ່ງຊື້: <?= $rs['orderID']; ?></p>
                <p>ລະຫັດລູກຄ້າ: <?= $rs['cus_id']; ?> </p>
                <p>ຊື່ແລະນາມສະກຸນ (ລູກຄ້າ): <?= $rs['cus_name']; ?></p>
                <p>ທີ່ຢູ່ການຈັດສົ່ງ: <?= $rs['address']; ?></p>
                <p>ເບີໂທລະສັບ: <?= $rs['telephone']; ?></p>

                <div class="card mb-4 mt-4">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ລະຫັດສິນຄ້າ</th>
                                    <th>ຊື່ສິນຄ້າ</th>
                                    <th>ລາຄາ</th>
                                    <th>ຈຳນວນທີ່ສັ່ງຊື້</th>
                                    <th>ລາຄາລວມ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // ดึงข้อมูลรายละเอียดการสั่งซื้อ
                                $sql1 = "SELECT * FROM order_detail d, product p WHERE d.pro_id=p.pro_id AND d.orderID='" . $_SESSION["order_id"] . "'";
                                $result1 = mysqli_query($conn, $sql1);
                                while ($row = mysqli_fetch_array($result1)) {
                                ?>
                                    <tr>
                                        <td><?= $row['pro_id'] ?></td>
                                        <td><?= $row['pro_name'] ?></td>
                                        <td><?= number_format($row['orderPrice'], 2) ?></td>
                                        <td><?= $row['orderQty'] ?></td>
                                        <td><?= number_format($row['Total'], 2) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <h6 class="text-end">ລວມເປັນເງິນ <?= number_format($total_price, 2) ?> ກີບ</h6>
                    </div>
                </div>
                <div>
                    <p>ກະລຸນາໂອນເງິນກາຍໃນ 7 ມື້ ຫຼັງຈາກທຳການສັ່ງຊື້ ໂອນເງິນຜ່ານທະນາຄານ ການຄ້າ ຊື່ບັນຊີ ສາຍສະໜອນ ພ້ອມສະຕິ ເລກບັນຊີ  000000</p>
                </div>
                <br>
                <div class="text-center">
                    <a href="show_product.php" class="btn btn-success">ກັບໄປທີ່ລາຍການສິນຄ້າ</a>
                    <button onclick="window.print()" class="btn btn-success">ພິມໃບສັ່ງຊຶ້</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
