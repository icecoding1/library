<?php
require_once("../function.php");
date_default_timezone_set("Asia/bangkok");
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $conn = new db;

  if (isset($_POST['sign_inAdmin'])) {
    $username = $_POST['username'];
    $password = $_POST['txt_password'];
    $hash_check = md5($password);

    try {
      $result = $conn->fetchOne("tb_officers", ["id", "f_name", "f_user"], ["f_user", "f_pass"], [$username, $hash_check]);
      $count_result = $conn->select_where("tb_officers", ["f_user", "f_pass"], [$username, $hash_check]);
      // $count = count($result);
      if ($count_result < 1) {
        http_response_code(400);
        $responce =  ["echo_res" => "ไม่มีชื่อผู้ใช้บัญชีนี้"];
        echo json_encode($responce);
      } else if ($count_result >= 1) {
        http_response_code(200);
        $_SESSION['id_admin'] = $result['id'];
        $_SESSION['name_admin'] = $result['f_name'];
        $_SESSION['username_admin'] = $result['f_user'];
        $responce =  ["echo_res" => "กำลังเข้าสู่ระบบ"];
        echo json_encode($responce);
      }
      // echo json_encode($result);
    } catch (Exception $e) {
      http_response_code(500);
      echo "SERVER ERROR" . $e->getMessage();
    }
  }
}
