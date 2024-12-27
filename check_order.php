<?php
session_start();
include 'configdb.php';
?>
<!doctype html>
<html lang="en">
<head>
    <title>ສະຖານະສັ່ງຊື້ສິນຄ້າ</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
<?php include 'Menu.php'; ?>
<div class="container">
    <div class="card-body mt-5">
        <div
            class="alert alert-success"
            role="alert"
        >
            <h4 class="alert-heading">ກວດສອບສະຖານະການສັ່ງຊື້ສິນຄ້າ</h4>
           
            <hr />
            <p class="mb-0">ລາຍລະອຽດສິນຄ້າ</p>
        </div>
        
        <table id="datatablesSimple" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ເລກທີ່ໃບສັ່ງຊື້</th>
                    <th>ຊື່ລູກຄ້າ</th>
                    <th>ທີ່ຢູ່ຈັດສົ່ງ</th>
                    <th>ລາຄາລວມສຸດທິ</th>
                    <th>ວັນທີ່ສັ່ງຊື້</th>
                    <th>ສະຖານະສັ່ງຊື້</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tb_order WHERE cus_id='" . $_SESSION['cus_userid'] . "'";
                $hand = mysqli_query($conn, $sql);
                
                while ($row = mysqli_fetch_array($hand)) {
                    $orderStatus = $row['order_status'];
                ?>
                <tr>
                    <td><?= $row['orderID'] ?></td>
                    <td><?= $row['cus_name'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['total_price'] ?></td>
                    <td><?= $row['reg_date'] ?></td>
                    <td>
                        <?php 
                        if ($orderStatus == '1') {
                            //add text alert red for merchant
                            echo "<span class='badge bg-danger'>ຢູ່ລະຫວ່າງການກວດສອບ</span>";
                          
                        } elseif ($orderStatus == '2') {
                            //add text alert green for customer
                            echo "<span class='badge bg-success'>ດຳເນິນການຈ່າຍເງິນແລ້ວ</span>";
                        }                     
                         elseif ($orderStatus == '0') {
                            echo "ຍົກເລິກສິນຄ້າ";
                        } elseif ($orderStatus == '3') {
                            echo "<span class='badge bg-danger'>ກຳລັງຈັດສົ່ງສິນຄ້າຂອງທ່ານ</span>";
                            
                        }
                        ?>
                    </td>
                </tr>
                <?php
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>

