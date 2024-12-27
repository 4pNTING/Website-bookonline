<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <title>LINE Notify</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    
    <style>
        body { font-family: 'Saysettha Unicode', sans-serif; }
        h1, h4 { text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <form action="insert_Line.php" method="POST" onsubmit="return validateForm()">
            <br>
            <h4>ແຈ້ງເຕືອນຜ່ານ Line Notify</h4>
            <br>
            <?php
    if(isset($_SESSION['success'])){ ?>
        <div class="alert alert-success" role="alert">
           <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php } ?>
    <?php
    if(isset($_SESSION['error'])){ ?>
        <div class="alert alert-error" role="alert">
           <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>
            <div class="mb-3">
                <label for="lineid" class="form-label">Name:</label>
                <input type="text" class="form-control" id="lineid" name="pname" placeholder="Name - Surname" required />
            </div>
            <div class="mb-3">
                <label for="lineemail" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="lineemail" name="email" placeholder="name@example.com" required />
            </div>
            <div class="mb-3">
                <label for="line_mid" class="form-label">Address:</label>
                <textarea class="form-control" id="line_mid" name="address" placeholder="Enter your address" rows="3" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        function validateForm() {
            var name = document.getElementById('lineid').value.trim();
            var email = document.getElementById('lineemail').value.trim();
            var address = document.getElementById('line_mid').value.trim();

            if (name === "" || email === "" || address === "") {
                alert("Please fill in all fields.");
                return false; // Prevent form submission
            }

            // If you need to check email format
            var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                alert("Please enter a valid email address.");
                return false; // Prevent form submission
            }

            // If all checks are passed, return true to allow form submission
            return true;
        }
    </script>
</body>
</html>
