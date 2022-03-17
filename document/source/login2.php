<?php
    session_start();
    include('doconfig.php'); 

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, intitial-scale=1.0">
  <title>เข้าสู่ระบบ</title>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  height: 50px;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}



.container {
  padding: 16px;
}

span.pwd {
  float: right;
  padding-top: 16px;
}

</style>
</head>

<body>
<!-- < ?php
    // if ($_POST){
    //     $usern = $_POST['usern'];
    //     $passw = $_POST['pwd'];
    // require_once("doconfig.php");
    // $sql = "INSERT 
    //         INTO staff (username, passwd) 
    //         VALUES (?, ?)";
    // $stmt = $mysqli->prepare($sql);
    // $stmt->bind_param("ss", $usern, $passw);
    // $stmt->execute();
    // header("location: docdb.php");}
?> -->

<h1 align="center">เข้าสู่ระบบ</h1>

<h2 align="center">หน้าค้นหาคำสั่งแต่งตั้ง</h2>

<form action="login.php" method="post">

              <?php include('errors.php'); ?>
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="error">
                        <h3>
                            <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                        </h3>
                    </div>
                <?php endif ?>
  
  <div class="container">
    <label for="username"><b>ชื่อผู้ใช้งาน</b></label>
    <input type="text" placeholder="Username" name="username" required>

    <label for="pwd"><b>รหัสผ่าน</b></label>
    <input type="password" placeholder="Password" name="pwd" required>
        
    <button type="submit" name="login_usern">เข้าสู่ระบบ</button>
    <!-- <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label> -->
  </div>
  <p><a href="register2.php">ลงทะเบียน</a></p>

  <!-- <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div> -->
</form>

</body>
</html>