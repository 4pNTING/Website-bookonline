<?php
session_start();
include 'configdb.php'; // ເຊື່ອມຕໍ່ຄວາມຂອງຄະນະບໍລິສັດ
if(!isset($_SESSION["cus_userid"])){
    header('location:login.php');
}
?>

<!doctype html>
<html lang="th">

<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include('Menu.php'); // ເຊື່ອມຕໍ່ຫມາຍເນມູດ
    ?>
    <br><br>
    <div class="container">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="alert alert-success mb-0" role="alert">ການສັ່ງຊື້ສິນຄ້າ</h4>
            </div>
            <div class="card-body">
                <form id="form1" method="POST" action="insert_cart.php">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ລຳດັບ</th>
                                <th>ຊື່ສິນຄ້າ</th>
                                <th>ລາຄາ</th>
                                <th>ຈຳນວນ</th>
                                <th>ລາຄາລວມ</th>
                                <th>ແກ້ໄຂຈຳນວນ</th>
                                <th>ລົບລາຍການ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sumPrice = 0;
                            $m = 1;
                            $sumtotal = 0;
                            if(isset($_SESSION["inTLine"])) {
                                for ($i = 0; $i <= (int)($_SESSION["inTLine"]); $i++) {
                                    if ($_SESSION["strProductID"][$i] != "") {
                                        $sql1 = "SELECT * FROM product WHERE pro_id='" . $_SESSION["strProductID"][$i] . "'";
                                        $result1 = mysqli_query($conn, $sql1);
                                        $row_pro = mysqli_fetch_array($result1);

                                        $_SESSION["price"] = $row_pro['price'];
                                        $Total = $_SESSION["strQty"][$i];
                                        $sum = $Total * $row_pro['price'];
                                        $sumPrice += $sum;
                                        $_SESSION["sum_Price"] = $sumPrice;
                                        $sumtotal = $sumtotal + $Total;
                            ?>
                                    <tr>
                                        <td><?= $m ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="Img/<?= $row_pro['image'] ?>" width="80" height="100" alt="image" class="border me-2">
                                                <?= $row_pro['pro_name'] ?>
                                            </div>
                                        </td>
                                        <td><?= number_format($row_pro['price'], 2) ?></td>
                                        <td><?= $_SESSION['strQty'][$i] ?></td>
                                        <td><?= number_format($sum, 0) ?></td>
                                        <td>
                                            <a href="Order.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-primary btn-sm">+</a>
                                            <?php if ($_SESSION["strQty"][$i] > 1) { ?>
                                                <a href="order_del.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-warning btn-sm">-</a>
                                            <?php } ?>
                                        </td>
                                        <td><a href="pro_delete.php?Line=<?= $i ?>"><img src="Img/delete.png" width="30" height="30" alt=""></a></td>
                                    </tr>
                            <?php
                                        $m = $m + 1;
                                    }
                                }
                            }
                            ?>
                            <tr>
                                <td class="text-end" colspan="4">ລວມເປັນເງິນ</td>
                                <td class="text-center"><?= number_format($sumPrice, 2) ?></td>
                                <td class="text-start">ກີບ</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-end">ຈຳນວນສິນຄ້າທີ່ສັ່ງຊື້ <?=$sumtotal?> ທັ້ງໝົດ</p>
                    <div class="d-flex justify-content-end">
                        <a href="show_product.php" class="btn btn-outline-secondary me-2">ເລືອກສິນຄ້າ</a>
                        <button type="submit" class="btn btn-outline-primary">ຢືນຍັນການສັ່ງຊື້</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4 shadow-sm col-4">
            <div class="card-header">
                <h4 class="alert alert-success mb-0" role="alert">ຂໍ້ມູນລຳດັບຈັດສົ່ງສິນຄ້າ</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <input type="text" name="cus_name" class="form-control" required placeholder="ຊື່ແລະນາມສະກຸນ" value="<?= $_SESSION['cus_firstname'] ?> <?= $_SESSION['cus_lastname'] ?>" >
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" required placeholder="ທີ່ຢູ່..." name="cus_add" rows="3"><?= $_SESSION['cus_address'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="cus_tel" class="form-control" required placeholder="ເບີໂທລະສັບ" value="<?= $_SESSION['cus_tel'] ?>">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="file1" class="form-control" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
