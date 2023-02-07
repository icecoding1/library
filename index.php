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
  <title>ระบบจัดการ ยืม-คืนหนังสือ</title>
  <link rel="stylesheet" href="assets/css/library.css">
  <?php include("structure/include_css.php")  ?>
</head>

<body class="bg_index">
  <a href="logout.php" class="text-black p-2">↩ออกจากระบบ</a>
  <div class="container w-100 my-5  d-flex flex-column  align-item-center">

    <center>
      <p class="fw-bold fs-3 text-center">ระบบจัดการการยืม-คืนห้องสมุด</p>
      <form class="d-flex gap-2 w-50 " method="post" id="form_search">
        <input type="text" name="search" id="search_name" class="form-control border border-secondary" placeholder="ค้าหารายชื่อ ผู้ยืม ผุู้คืน หนังสือ...">
        <button type="button" class="btn btn-secondary ">ค้นหา</button>
      </form>
    </center>

    <div class="mt-3 mb-1 text-end">
      <a href="borrow_book.php" class="btn btn-secondary">ยืมหนังสือ</a>
      <a href="statistics.php" class="btn btn-secondary">ข้อมูลสถิติ</a>
    </div>

    <table class="table-bordered w-100 mt-2">
      <thead>
        <tr>
          <th scope="col" class="text-center">รหัสหหนังสือ</th>
          <th scope="col" class="text-center">ชื่อหนังสือ</th>
          <th scope="col" class="text-center">ผู้ยืม-คืน</th>
          <th scope="col" class="text-center">วันที่ยืม</th>
          <th scope="col" class="text-center">วันที่คืน</th>
          <th scope="col" class="text-center">ค่าปรับ</th>
          <th scope="col" class="text-center"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row" class="text-center p-2">1</th>
          <th scope="row" class="text-center p-2">1</th>
          <th scope="row" class="text-center p-2">1</th>
          <th scope="row" class="text-center p-2">1</th>
          <th scope="row" class="text-center p-2">1</th>
          <th scope="row" class="text-center p-2">1</th>
          <th scope="row" class="text-center p-2">
            <a href="return_book.php?id=1" class="btn btn-warning">คืนหนังสือ</ฟ>
          </th>
        </tr>
      </tbody>
    </table>

  </div>
  <?php include("structure/include_js.php")  ?>
</body>

</html>