<?php
session_start();
require_once("backend/function.php");
$conn  = new db;
isset($_SESSION['name_admin']) && isset($_SESSION['username_admin']) ? '' : header("location:login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบจัดการ คืนหนังสือ</title>
  <link rel="stylesheet" href="assets/css/library.css">
  <?php include("structure/include_css.php")  ?>
</head>

<body class="bg_index">
  <a href="index.php" class="text-black p-2">↩กลับ</a>
  <div class="container w-100 my-5 d-flex justify-content-center flex-warp">

    <div class="d-flex flex-wrap   align-item-center">
      <div class="p-5">
        <p>หนังสือทั้งหมด(เล่ม)</p>
        <div class="bg-success p-4 text-center border-secondary shadow ">
          <h1 class="fw-bold">5</h1>
        </div>
      </div>


      <div class="p-5">
        <p>การใช้บริการยืมคืน(ครั้ง)</p>
        <div class="bg-info p-4 text-center border-secondary shadow ">
          <h1 class="fw-bold">5</h1>
        </div>
      </div>
    </div>



    <div class="d-flex flex-wrap   align-item-center">
      <div class="p-5">
        <p>สมาชิกทั้งหมด(คน)</p>
        <div class="bg-warning p-4 text-center border-secondary shadow ">
          <h1 class="fw-bold">5</h1>
        </div>
      </div>


      <div class="p-5">
        <p>หนังสทอค้างส่ง(เล่ม)</p>
        <div class="bg-danger p-4 text-center border-secondary shadow ">
          <h1 class="fw-bold">5</h1>
        </div>
      </div>
    </div>


  </div>
  <?php include("structure/include_js.php")  ?>
</body>

</html>