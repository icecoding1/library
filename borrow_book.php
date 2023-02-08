<?php
session_start();
require_once("backend/function.php");
$conn  = new db;
isset($_SESSION['name_admin']) && isset($_SESSION['username_admin']) ? '' : header("location:login.php");
$result_book = $conn->fetchAll("tb_book", ['*']);
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
      <form method="post" id="form_search_name" class="mb-2">
        <div class="row justify-content-center align-items-center">
          <p class="col-2 mb-0 ">ผุุ้ที่ต้องการยืม</p>
          <input type="text" name="search_name" id="search_name" class="form-control border border-secondary w-50 col-9" placeholder="กรอกชื่อผู้ใช้">
          <button type="submit" class="btn btn-secondary col-1 mx-2">ตกลง</button>
        </div>
      </form>
      <form method="post" id="form_search_book">
        <div class="row justify-content-center align-items-center">
          <p class="col-2 mb-0 fw-bold">รหัสหนังสือ</p>
          <input type="text" name="search_book" id="search_book" class="form-control border border-secondary w-50 col-9" placeholder="กรอกรหัสหนังสือ" list="books">
          <button type="submit" class="btn btn-secondary col-1 mx-2">ตกลง</button>
        </div>

        <datalist id="books">
          <?php foreach ($result_book as $data) { ?>
            <option value="<?= $data['code_book'] ?>">
            <?php } ?>
        </datalist>
      </form>
    </center>

    <center>

      <table class="table-bordered w-50 mt-5">
        <tbody>
          <tr>
            <td class="text-end p-2 fw-bold" style="width:20%">ชื่อ-สกุลผู้ยืม :</td>
            <td class="text-center p-2">
              <p class="mb-0" id="detail_name"></p>
            </td>
          </tr>
          <tr>
            <td class="text-end p-2 fw-bold" style="width:20%">รหัสหนังสือ :</td>
            <td class="text-center p-2">
              <p class="mb-0" id="code_book"></p>
            </td>
          </tr>
          <tr>
            <td class="text-end p-2 fw-bold" style="width:20%">ชื่อหนังสือ :</td>
            <td class="text-center p-2">
              <p class="mb-0" id="name_book"></p>
            </td>
          </tr>
          <tr>
            <td class="text-center p-1" colspan="2">
              <form class="d-flex w-100 justify-content-center gap-2" method="post" id="confirm_borrow">
                <button class="btn btn-secondary">ยืมหนังสือ</button>
                <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
                <input type="hidden" name="code_book" id="code_book_input">
                <input type="hidden" name="name_user" id="name_user_input">
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </center>

  </div>
  <?php include("structure/include_js.php")  ?>
  <script>
    var form_search_name = document.getElementById("form_search_name");
    var form_search_book = document.getElementById("form_search_book");
    var confirm_borrow = document.getElementById("confirm_borrow");
    var detail_name = document.getElementById("detail_name");
    var code_book = document.getElementById("code_book");
    var name_book = document.getElementById("name_book");
    var name_user_input = document.getElementById("name_user_input");
    var code_book_input = document.getElementById("code_book_input");


    form_search_name.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData(form_search_name);
      formData.append("search_name_chcek", 1);

      const data = await fetch("backend/borrow/index.php", {
        method: "POST",
        body: formData
      })
      const res = await data.text();
      if (res == "ไม่พบข้อมูลสมาชิก") {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: res,
          showConfirmButton: false,
          timer: 1500
        })
        // setInterval(() => {
        //   location.assign("borrow_book.php");
        // }, 1000)
      } else {
        detail_name.innerText = res;
        name_user_input.value = res;
      }
    })

    form_search_book.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData(form_search_book);
      formData.append("search_book_chcek", 1);

      const data = await fetch("backend/borrow/index.php", {
        method: "POST",
        body: formData
      })
      const res = await data.json();
      // console.log(res);
      if (res.echo_res == "ไม่พบข้อมูลหนังสือ") {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: res.echo_res,
          showConfirmButton: false,
          timer: 1500
        })
      } else {
        name_book.innerText = res.name_book;
        code_book.innerText = res.code_book;
        code_book_input.value = res.code_book;
      }
    })


    confirm_borrow.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData(confirm_borrow);
      formData.append("confirm_borrow_books", 1);

      const data = await fetch("backend/borrow/index.php", {
        method: "POST",
        body: formData
      })
      const res = await data.text();
      if (res == "เพิ่มข้อมูลสำเร็จ") {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: res,
          showConfirmButton: false,
          timer: 1500
        })
        setInterval(() => {
          location.assign("borrow_book.php");
        }, 1000)
      } else {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: res,
          showConfirmButton: false,
          timer: 1500
        })
      }
    })
  </script>
</body>

</html>