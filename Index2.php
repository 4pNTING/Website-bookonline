<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="type_id">Product Type:</label>
    <select name="type_id" id="type_id">
        <?php
        // Fetch product types from the database
        include('configdb.php');
        $sql = "SELECT type_id, type_name FROM type";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
        }
        mysqli_close($conn);
        ?>
    </select>
    <br>
    <label for="pro_name">Product Name:</label>
    <input type="text" name="pro_name" id="pro_name" required>
    <br>
    <label for="detail">Product Details:</label>
    <textarea name="detail" id="detail"></textarea>
    <br>
    <label for="price">Price:</label>
    <input type="number" name="price" id="price" required>
    <br>
    <label for="amount">Amount:</label>
    <input type="number" name="amount" id="amount" required>
    <br>
    <label for="image">Image:</label>
    <input type="file" name="image" id="image" required>
    <br>
    <input type="submit" value="Upload">
</form>   




        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
