<?php
include 'configdb.php';
session_start();
if (!isset($_SESSION['cus_userid'])) {
  session_destroy();
  header("location: login.php");
  exit();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">MyShop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- ส่วนของเมนูด้านซ้าย -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">ໜ້າຫຼັກ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="show_product.php">ສິນຄ້າ</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ແຈ້ງຊຳລະເງິນ
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="pay_ment.php">ສົ່ງໃບບິນຊຳລະເງິນ</a></li>
            <li><a class="dropdown-item" href="check_order.php">ເຊັດສະຖານະການສັ່ງຊື້ສິນຄ້າ</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">ລາຍງານ</a></li>
          </ul>
        </li>
      </ul>

      <!-- ส่วนแสดงชื่อผู้ใช้หรือ session -->
      <?php 
      if (isset($_SESSION['cus_firstname']) && isset($_SESSION['cus_lastname'])) {
        echo '<ul class="navbar-nav ms-auto">';
        echo '<li class="nav-item">';
        echo '<b class="nav-link">';
        echo 'ຍິນດີຕ້ອນຮັບ: ' . $_SESSION['cus_firstname'] . " " . $_SESSION['cus_lastname'];
        echo '</b>';
        echo '</li>';
        echo '</ul>';
      }
      ?>
      
      <!-- ส่วนของเมนูด้านขวา -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Login
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="login.php">Login</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            <li><a class="dropdown-item" href="#">Register</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="admin/index.php" class="nav-link">Login admin</a>
        </li>
      </ul>

      <!-- ส่วนของช่องค้นหา -->
      <form class="d-flex ms-lg-3" role="search">
        <input class="form-control me-2 border-primary shadow-sm" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
 </div>
</nav>
