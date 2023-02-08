<?php
session_start();
require_once("backend/function.php");
$conn  = new db;
isset($_SESSION['name_admin']) && isset($_SESSION['username_admin']) ? '' : header("location:login.php");
$id_br = isset($_GET['id']) ? $_GET['id'] : header("location:index.php");
empty($_GET['id']) ? header("location:index.php") : '';
$result_detail = $conn->select_join_where(["tb_book.b_name", "tb_borrow_book.*"], "tb_borrow_book", "tb_book", " tb_borrow_book.b_code = tb_book.code_book ", ["tb_borrow_book.id"], [$id_br]);
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
  <div class="container w-100 my-5  d-flex flex-column  align-item-center">
    <center>
      <p class="fw-bold fs-3 text-center"><?= $result_detail['status'] == 0 ? 'คืนหนังสือ' : 'คืนหนังสือเรียบร้อย' ?></p>
    </center>

    <center>

      <form method="POST" id="return_books">
        <table class="table-bordered w-50 mt-5">
          <tbody>
            <tr>
              <td class="text-end p-2 fw-bold" style="width:20%">รหัสหนังสือ :</td>
              <td class="text-center p-2">
                <p class="mb-0"><?= $result_detail['b_code'] ?></p>
              </td>
            </tr>
            <tr>
              <td class="text-end p-2 fw-bold" style="width:20%">ชื่อหนังสือ :</td>
              <td class="text-center p-2">
                <p class="mb-0"><?= $result_detail['b_name'] ?></p>
              </td>
            </tr>
            <tr>
              <td class="text-end p-2 fw-bold" style="width:20%">ผู้ยืม-คืนหนังสือ :</td>
              <td class="text-center p-2">
                <p class="mb-0"><?= $result_detail['m_user'] ?></p>
              </td>
            </tr>
            <tr>
              <td class="text-end p-2 fw-bold" style="width:20%">วันที่ยืม :</td>
              <td class="text-center p-2">
                <p class="mb-0"><?= date("d/m/Y", strtotime($result_detail['br_date_br'])) ?></p>
              </td>
            </tr>
            <tr>
              <td class="text-end p-2 fw-bold" style="width:20%">ค่าปรับ :</td>
              <td class=" p-2">
                <?php if ($result_detail['status'] == 0) { ?>
                  <input type="number" name="fine" id="fine" placeholder="กรอกค่าหรับหนังสือ" class="form-control w-100 border-secondary" value="<?= $result_detail['br_fine'] ?>">
                <?php } else { ?>
                  <p class="mb-0 text-center"><?= $result_detail['br_fine'] ?></p>
                <?php  } ?>
              </td>
            </tr>
            <tr class="<?= $result_detail['status'] == 0 ? '' : 'd-none' ?>">
              <td class="text-center p-1" colspan="2">
                <button class="btn btn-secondary" type="submit">คืนหนังสือ</button>
                <a href="index.php" class="btn btn-secondary">ยกเลิก</ฟ>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </center>

  </div>
  <?php include("structure/include_js.php")  ?>
  <script>
    var return_books = document.getElementById("return_books");

    return_books.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData(return_books);
      formData.append("confirm_return_books", <?= $id_br ?>);

      const data = await fetch("backend/borrow/index.php", {
        method: "POST",
        body: formData
      })
      const res = await data.text();
      if (res == "คืนหนังสือสำเร็จ") {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: res,
          showConfirmButton: false,
          timer: 1500
        })
        setInterval(() => {
          location.assign("return_book.php");
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