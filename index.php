<?php
include('configdb.php'); // Include the database configuration file

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// กำหนดจำนวนสินค้าที่จะแสดงในแต่ละหน้า
$products_per_page = 8;

// ตรวจสอบหน้าที่ผู้ใช้เลือก หากไม่มีกำหนดให้ใช้หน้าแรก (หน้า 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// คำนวณจุดเริ่มต้น (offset) ของสินค้าที่จะแสดงในหน้าปัจจุบัน
$offset = ($page - 1) * $products_per_page;

// Query เพื่อดึงสินค้าตามจำนวนที่กำหนดพร้อมจัดเรียง
$sql = "SELECT * FROM product ORDER BY pro_id LIMIT $products_per_page OFFSET $offset";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>MyShop</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
        <link rel="stylesheet" href="https://unpkg.com/tippy.js@6.3.7/dist/tippy.css" />
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>

</head>
<style>
    
        body { background-color: #f0f0f5; font-family: 'Defago Noto Sans Lao', sans-serif; }
        .product-card { border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s; }
        .product-card:hover { transform: scale(1.05); }
        .product-image { border-radius: 8px; }
        .pagination .page-link { color: #007bff; }
        .pagination .page-item.active .page-link { background-color: #007bff; border-color: #007bff; color: white; }
    </style>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

<body>
<?php
include('Menu.php');
include('header.php');
?>

<div class="container text-center" style="background-color:#ffffff;">
    <div class="row">
    <?php
        while ($row = mysqli_fetch_array($result)) {
            $amount1 = $row['amount'];
        ?>
            <div class='col-md-3'>
                <div class='card product-card'>
                    <img src='img/<?php echo htmlspecialchars($row['image']); ?>' class='card-img-top product-image' width='200px' height='250px' alt='Product Image'>
                    <div class='card-body text-center'>
                        <h6 class="text-muted">ID: <?php echo htmlspecialchars($row['pro_id']); ?></h6>
                        <h5 class="card-title text-success"><?php echo htmlspecialchars($row['pro_name']); ?></h5>
                        <p class="card-text text-danger"><strong><?php echo number_format($row['price'], 2); ?></strong> ກີບ</p>
                        <?php if ($amount1 <= 0) { ?>
                            <button class="btn btn-danger disabled mt-3">ສິນຄ້າໝົດ</button>
                        <?php } else { ?>
                            <a class="btn btn-primary mt-2" href="Order.php?id=<?php echo htmlspecialchars($row['pro_id']); ?>">Add to Cart</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <br>
    <br>

    
    <!-- Pagination Section -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php
            // Query เพื่อนับจำนวนสินค้าทั้งหมด
            $total_products_query = "SELECT COUNT(*) as total FROM product";
            $total_products_result = mysqli_query($conn, $total_products_query);
            $total_products = mysqli_fetch_assoc($total_products_result)['total'];

            // คำนวณจำนวนหน้าทั้งหมด
            $total_pages = ceil($total_products / $products_per_page);

            // แสดงปุ่มย้อนกลับ
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page='.($page - 1).'">ກ່ອນໜ້າ</a></li>';
            }

            // แสดงเลขหน้า
            for ($i = 1; $i <= $total_pages; $i++) {
                $active_class = ($i == $page) ? 'active' : '';
                echo '<li class="page-item '.$active_class.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
            }

            // แสดงปุ่มถัดไป
            if ($page < $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="?page='.($page + 1).'">ຖັດໄປ</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>

<?php
include('footer.php');
mysqli_close($conn); // ปิดการเชื่อมต่อหลังจากส่วนแบ่งหน้า
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
