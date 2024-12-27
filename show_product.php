<?php
include('configdb.php'); // Include the database configuration file

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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
</head>

<body>
<?php
include('Menu.php');
?>

    <div class="container text-center">
        <div class="row">

            <?php
            // SQL query to select all products from the database ordered by product ID
           // $sql = "SELECT * FROM product where amount > 0 ORDER BY pro_id "; // ຖ້າສິນຄ້າເຫຼືອ 0 ຈະບໍ່ສະແດງ
            $sql = "SELECT * FROM product where amount >= 0  ORDER BY pro_id "; // ຖ້າສິນຄ້າເຫຼືອ 0 ຈະບໍ່ສະແດງ
            $result = mysqli_query($conn, $sql);

            // Check if the query was successful
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            // Loop through each product in the result set
            while ($row = mysqli_fetch_array($result)) {
                $amount1=$row['amount'];
                $image1=$row['image'];

            ?>
                <div class='col-sm-3'> <!-- Create a product card column -->
                    <div class='text-center'> <!-- Add a div for text centering -->
                    <?php
    if ($image1 == '') {
        echo "<img src='img/no_image.jpg' width='200px' height='250px' alt='Product Image' class='mt-5 p-2 my-2 border'>";
    } else {
        echo "<img src='img/" . $row['image'] . "' width='200px' height='250px' alt='Product Image' class='mt-5 p-2 my-2 border'>";
    }
?>


                        <!-- Display the product image -->
                        
                        <br>

                        <!-- Display product ID, name, and price -->
                        ID : <?php echo htmlspecialchars($row['pro_id']); ?><br>
                        <h5 class="text-success"><?php echo htmlspecialchars($row['pro_name']); ?></h5>

                        ລາຄາ: <b class="text-danger"><?php echo number_format($row['price'], 2); ?> </b>ກີບ<br> <!-- Format price -->
                        <?php
        // ตรวจสอบจำนวนสินค้าคงเหลือ
        if ($amount1 <= 0) { ?>
            <a class="btn btn-danger mt-3" href="#">ສິນຄ້າໝົດ</a>
        <?php } else { ?>
            <a class="btn btn-success mt-2" href="Order.php?id=<?php echo htmlspecialchars($row['pro_id']); ?>">add cart</a>
        <?php } ?>
                    </div> <!-- Close the text-center div -->
                    <br> <!-- Add a line break -->
                </div> <!-- Close the product card column -->
            <?php
            }

            // Close the database connection
            mysqli_close($conn);
            ?>

        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

</body>

</html>
