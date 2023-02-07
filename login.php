<?php
session_start();
isset($_SESSION['name_admin']) && isset($_SESSION['username_admin']) ? header("location:index.php") : '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
  <link rel="stylesheet" href="assets/css/library.css">
  <?php include("structure/include_css.php")  ?>
</head>

<body>
  <div class=" d-flex flex-column bg-secondary" style="min-height:100vh;">

    <div class=" d-flex align-items-center justify-content-center my-auto ">
      <div class="bg-white p-3 py-4 " style="min-width:320px;  border-radius:10px;">
        <form id="login" method="post">
          <div class="box-header d-flex flex-column align-items-center justify-cintent-center">
            <h1 class="fw-bold">เข้าสู่ระบบ</h1>
          </div>

          <div class="form-floating mb-1">
            <input type="text" class="form-control" id="username" name="username" required>
            <label for="username">Username</label>
          </div>
          <div class="form-floating mb-1">
            <input type="password" class="form-control" id="txt_password" name="txt_password" required>
            <label for="password">Password</label>
          </div>

          <div class="checkbox mb-2">
            <label>
              <input type="checkbox" name="show_password" id="show_password"> show password
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit"><a>Sign in</a></button>
        </form>
      </div>
    </div>

  </div>
  <?php include("structure/include_js.php")
  ?>
  <script src="assets/framework/js.min.css"></script>
  <script>
    var show_password = document.getElementById("show_password");
    var password = document.getElementById("txt_password");
    var form_login = document.getElementById("login");

    show_password.addEventListener("click", () => {
      if (show_password.checked == true) {
        password.type = 'text';
      } else if ((show_password.checked == false)) {
        password.type = 'password';
      }
    })

    form_login.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData(form_login);
      formData.append("sign_inAdmin", 1);

      const data = await fetch("backend/signin/index.php", {
        method: "POST",
        body: formData
      })
      const res = await data.text();
      if (res == "กำลังเข้าสู่ระบบ") {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: res,
          showConfirmButton: false,
          // timer: 1500
        })
        setInterval(() => {
          location.assign("index.php");
        }, 1000)
      } else {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: res,
          showConfirmButton: false,
          // timer: 1500
        })
      }
    })
  </script>
</body>


</html>