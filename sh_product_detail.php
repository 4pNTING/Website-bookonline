<?php
include('configdb.php'); // Include the database configuration file

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the product ID from the URL
$ids = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Use prepared statements to avoid SQL injection
$stmt = $conn->prepare("SELECT * FROM product JOIN type ON product.type_id = type.type_id WHERE product.pro_id = ?");
$stmt->bind_param("i", $ids); // "i" indicates that we are binding an integer
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows == 0) {
    die("Product not found."); // Handle case where product is not found
}

// Fetch the product details
$row = $result->fetch_assoc();

$stmt->close(); // Close the prepared statement
?>

<!doctype html>
<html lang="en">
<head>
    <title>Myshop</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <?php include('Menu.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="img/<?php echo htmlspecialchars($row['image']); ?>" width="350px" class="mt-2 p-2 my-2 border" alt="Product Image" />
            </div>

            <div class="col-md-6">
                <br><br>
                ID : <?php echo htmlspecialchars($row['pro_id']); ?><br>
                <h5 class="text-success"><?php echo htmlspecialchars($row['pro_name']); ?></h5>
                ປະເພດສິນຄ້າ: <?php echo htmlspecialchars($row['type_name']); ?><br>
                ລາຍລະອຽດ: <?php echo htmlspecialchars($row['detail']); ?><br>
                ລາຄາ: <b class="text-danger"><?php echo number_format($row['price'], 2); ?></b> ກີບ<br>
                <a class="btn btn-outline-success mt-2" href="Order.php?id=<?php echo $row['pro_id']; ?>">add cart</a>
            </div>
        </div>
    </div>

    <?php $conn->close(); // Close the database connection ?>
</body>
</html>
