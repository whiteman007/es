<?php
    session_start();
    $message="";
    if(count($_POST)>0) {
		$sql="SELECT * FROM users WHERE username='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'";
        $con = mysqli_connect('localhost','root','','website_db') or die('Unable To connect');
		$con->set_charset("utf8");
        $result = mysqli_query($con,"SELECT * FROM users WHERE username='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
		echo "<script>window.alert(".$sql.");</script>";
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['user_id'];
        $_SESSION["username"] = $row['username'];
		$_SESSION["name"] = $row['name'];
        } else {
         $message = "Invalid Username or Password!";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:admin-index.php");
    }
?>



<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style2.css" />
    <title>تسجيل الدخول</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" class="sign-in-form" method="post">
            <h2 class="title">تسجيل الدخول</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="user_name" placeholder="اسم المستخدم" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="كلمة المرور" />
            </div>
            <input type="submit" name="submit" value="سجل الدخول" class="btn solid" />
           
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
          
          </div>
          <!--<img src="" class="image" alt="" />-->
        </div>
          </div>
        </div>


    <script src="app.js"></script>
  </body>
</html>
