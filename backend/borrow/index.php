<?php
require_once("../function.php");
date_default_timezone_set("Asia/bangkok");
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $conn = new db;

  if (isset($_POST['search_name_chcek'])) {
    $name = $_POST['search_name'];

    try {
      $result = $conn->fetchOne("tb_member", ["id", "m_user", "m_name"], ["m_user"], [$name]);
      $count_result = $conn->select_where("tb_member", ["m_user"], [$name]);
      // $count = count($result);
      if ($count_result < 1) {
        http_response_code(400);
        echo "ไม่พบข้อมูลสมาชิก";
      } else if ($count_result >= 1) {
        http_response_code(200);
        echo $result['m_name'];
      }
    } catch (Exception $e) {
      http_response_code(500);
      echo "SERVER ERROR" . $e->getMessage();
    }
  }

  if (isset($_POST['search_book_chcek'])) {
    $code_book = $_POST['search_book'];

    try {
      $result = $conn->fetchOne("tb_book", ["id", "code_book", "b_name"], ["code_book"], [$code_book]);
      $count_result = $conn->select_where("tb_book", ["code_book"], [$code_book]);
      // $count = count($result);
      if ($count_result < 1) {
        http_response_code(400);
        $responce =  ["echo_res" => "ไม่พบข้อมูลหนังสือ"];
        echo json_encode($responce);
      } else if ($count_result >= 1) {
        http_response_code(200);
        $responce = [
          "code_book" => $result['code_book'],
          "name_book" => $result['b_name']
        ];
        echo json_encode($responce);
      }


      // $responce = [
      //   "code_book" => $code_book,
      //   "name_book" => $code_book
      // ];
      // echo json_encode($responce);
    } catch (Exception $e) {
      http_response_code(500);
      echo "SERVER ERROR" . $e->getMessage();
    }
  }

  if (isset($_POST['confirm_borrow_books'])) {
    $code_book = $_POST['code_book'];
    $name_user = $_POST['name_user'];

    try {
      $result = $conn->insert("tb_borrow_book", ["b_code", "m_user"], [$code_book, $name_user]);
      if ($result) {
        http_response_code(200);
        echo "เพิ่มข้อมูลสำเร็จ";
      } else {
        http_response_code(400);
        echo "เพิ่มข้อมูลไม่สำเร็จ";
        exit;
      }
    } catch (Exception $e) {
      http_response_code(500);
      echo "SERVER ERROR" . $e->getMessage();
      exit;
    }
  }

  if (isset($_POST['confirm_return_books'])) {
    $fine = $_POST['fine'];
    $id = $_POST['confirm_return_books'];


    try {
      $result = $conn->update("tb_borrow_book", ["status", "br_fine"], [1, $fine], $id);
      if ($result) {
        http_response_code(200);
        echo "คืนหนังสือสำเร็จ";
      } else {
        http_response_code(400);
        echo "คืนหนังสือไม่สำเร็จ";
        exit;
      }
    } catch (Exception $e) {
      http_response_code(500);
      echo "SERVER ERROR" . $e->getMessage();
      exit;
    }
  }
}
