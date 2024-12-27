<?php
include('configdb.php');

// Check if the form has been submitted and a file has been uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $errors = [];
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif');

    if (in_array($file_type, $allowed_mime_types)) {
        if ($file_size < 2097152) { // 2MB limit
            $new_filename = time() . "." . $file_ext;
            $target_dir = "img/";
            $target = $target_dir . $new_filename;

            // Check if the directory exists, if not, create it
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Attempt to move the uploaded file
            if (move_uploaded_file($file_tmp, $target)) {
                // Insert product data into the database using prepared statements
                $stmt = $conn->prepare("INSERT INTO product (pro_name, detail, type_id, price, amount, image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssisss", $pro_name, $detail, $type_id, $price, $amount, $new_filename);

                $pro_name = $_POST['pro_name'];
                $detail = $_POST['detail'];
                $type_id = $_POST['type_id'];
                $price = $_POST['price'];
                $amount = $_POST['amount'];

                if ($stmt->execute()) {
                    echo "Product uploaded successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                // Debugging information
                echo "Debug Info: Temp File: $file_tmp, Target: $target";
                $errors[] = "There was a problem uploading the file. Please check file permissions or directory existence.";
            }
        } else {
            $errors[] = "File is too large. Maximum file size is 2MB.";
        }
    } else {
        $errors[] = "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
    }
} else {
    // Error handling
    if (isset($_FILES['image']['error'])) {
        switch ($_FILES['image']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $errors[] = "The file is too large (server limit).";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $errors[] = "The file is too large (form limit).";
                break;
            case UPLOAD_ERR_PARTIAL:
                $errors[] = "The file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $errors[] = "No file was uploaded.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $errors[] = "Missing a temporary folder.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $errors[] = "Failed to write file to disk.";
                break;
            case UPLOAD_ERR_EXTENSION:
                $errors[] = "File upload stopped by extension.";
                break;
            default:
                $errors[] = "Unknown error occurred during file upload.";
                break;
        }
    } else {
        $errors[] = "Please select a file to upload.";
    }
}

// Display error messages if any
if (count($errors) > 0) {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
}
?>
