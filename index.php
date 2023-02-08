<?php
session_start();
require_once("backend/function.php");
$conn  = new db;
isset($_SESSION['name_admin']) && isset($_SESSION['username_admin']) ? '' : header("location:login.php");
$keyword = isset($_POST['search_value']) ? $_POST['search_value'] : '';
if ($keyword == '') {
  $result = $conn->select_join(["tb_book.b_name", "tb_borrow_book.*"], "tb_borrow_book", "tb_book", " tb_borrow_book.b_code = tb_book.code_book ");
} else {
  $where_key = " tb_borrow_book.m_user LIKE '%$keyword%' OR tb_book.b_name LIKE '%$keyword%'  OR tb_borrow_book.b_code LIKE '%$keyword%' ";
  $result = $conn->select_joinSeachNew(["tb_book.b_name", "tb_borrow_book.*"], "tb_borrow_book", "tb_book", " tb_borrow_book.b_code = tb_book.code_book ", $where_key);
}
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

    <?php
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
    ?>
    <center>
      <p class="fw-bold fs-3 text-center">ระบบจัดการการยืม-คืนห้องสมุด</p>
      <form class="d-flex gap-2 w-50 " method="post" id="form_search" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="text" name="search_value" id="search_name" class="form-control border border-secondary" placeholder="ค้าหารายชื่อ ผู้ยืม ผุู้คืน หนังสือ..." value="<?= $keyword ?>">
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
        <?php
        if (count($result) == 0) { ?>
          <tr>
            <td scope="row" colspan="7" class="text-center p-2">ไม่มีข้อมูล</td>
          </tr>
        <?php } else { ?>
          <?php foreach ($result as $data) { ?>
            <tr>
              <td scope="row" class="text-center p-2"><?= $data['b_code'] ?></td>
              <td scope="row" class="text-center p-2"><?= $data['b_name'] ?></td>
              <td scope="row" class="text-center p-2"><?= $data['m_user'] ?></td>
              <td scope="row" class="text-center p-2"><?= date("d/m/Y", strtotime($data['br_date_br'])) ?></td>
              <td scope="row" class="text-center p-2"><?= $data['status'] == 1 ? date("d/m/Y", strtotime($data['br_date_tr'])) : $data['br_date_tr'] ?></td>
              <td scope="row" class="text-center p-2"><?= $data['br_fine'] ?></td>
              <td scope="row" class="text-center p-2">
                <a href="return_book.php?id=<?= $data['id'] ?>" class="btn  <?= $data['status'] == 0 ? 'btn-warning' : 'btn-success' ?>"><?= $data['status'] == 0 ? 'คืนหนังสือ' : 'รายละเอียด' ?></a>
              </td>
            </tr>
        <?php  }
        } ?>
      </tbody>
    </table>

  </div>
  <?php include("structure/include_js.php")  ?>
</body>

</html>