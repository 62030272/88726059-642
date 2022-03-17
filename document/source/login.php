<?php
session_start();
include('doconfig.php');
$errors = array();

    if (isset($_POST['login_usern'])) {
        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $pwd = mysqli_real_escape_string($mysqli, $_POST['pwd']);


        if (count($errors) == 0) {
            $password = md5($pwd);
            
            

            $query = "SELECT * FROM staff WHERE username = '$username' AND passwd = '$password' ";

            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "คุณกำลังเข้าสู่ระบบ";
                header("location: docdb.php");
            } else {
                array_push($errors, "ชื่อผู้ใช้ หรือ รหัสผ่านผิด");
                $_SESSION['error'] = "ชื่อผู้ใช้ หรือ รหัสผ่านผิด!";
                header("location: login2.php");
            }
        } else {
            array_push($errors, "ต้องระบุ ชื่อผู้ใช้ และ รหัสผ่าน");
            $_SESSION['error'] = "ต้องระบุ ชื่อผู้ใช้ และ รหัสผ่าน";
            header("location: login2.php");
        }
    }

?>
