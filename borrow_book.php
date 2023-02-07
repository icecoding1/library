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
  <title>ระบบจัดการ ยืมหนังสือ</title>
  <link rel="stylesheet" href="assets/css/library.css">
  <?php include("structure/include_css.php")  ?>
</head>

<body class="bg_index">
  <a href="index.php" class="text-black p-2">↩กลับ</a>
  <div class="container w-100 my-5  d-flex flex-column  align-item-center">

    <center>
      <p class="fw-bold fs-3 text-center">ยืมหนังสือ</p>
      <form method="post" id="form_search" class="mb-2">
        <div class="row justify-content-center align-items-center">
          <p class="col-2 mb-0 ">ผุุ้ที่ต้องการยืม</p>
          <input type="text" name="search_name" id="search_name" class="form-control border border-secondary w-50 col-9" placeholder="กรอกชื่อผู้ใช้">
          <button type="submit" class="btn btn-secondary col-1 mx-2">ตกลง</button>
        </div>
      </form>
      <form method="post" id="form_search">
        <div class="row justify-content-center align-items-center">
          <p class="col-2 mb-0 fw-bold">รหัสหนังสือ</p>
          <input type="text" name="search_books" id="search_books" class="form-control border border-secondary w-50 col-9" placeholder="กรอกรหัสหนังสือ">
          <button type="submit" class="btn btn-secondary col-1 mx-2">ตกลง</button>
        </div>
      </form>
    </center>

    <center>

      <table class="table-bordered w-50 mt-5">
        <tbody>
          <tr>
            <td class="text-end p-2 fw-bold" style="width:20%">ชื่อสกุลผู้ยืม :</td>
            <td class="text-center p-2">
              <p class="mb-0">detail</p>
            </td>
          </tr>
          <tr>
            <td class="text-end p-2 fw-bold" style="width:20%">รหัสหนังสือ :</td>
            <td class="text-center p-2">
              <p class="mb-0">detail</p>
            </td>
          </tr>
          <tr>
            <td class="text-end p-2 fw-bold" style="width:20%">ชื่อหนังสือ :</td>
            <td class="text-center p-2">
              <p class="mb-0">detail</p>
            </td>
          </tr>
          <tr>
            <td class="text-center p-1" colspan="2">
              <button class="btn btn-secondary">ยืมหนังสือ</button>
              <a href="index.php" class="btn btn-secondary">ยกเลิก</ฟ>
            </td>
          </tr>
        </tbody>
      </table>
    </center>

  </div>
  <?php include("structure/include_js.php")  ?>
</body>

</html>