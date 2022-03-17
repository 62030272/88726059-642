<?php 
    session_start();
    include('doconfig.php');
    
    $errors = array();

    if (isset($_POST['register_user'])) {
        $stfc = mysqli_real_escape_string($mysqli, $_POST['stfc']);
        $stfn = mysqli_real_escape_string($mysqli, $_POST['stfn']);
        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $pwd = mysqli_real_escape_string($mysqli, $_POST['pwd']);
        $pwdrepeat = mysqli_real_escape_string($mysqli, $_POST['pwdrepeat']);

        if (empty($username)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username is required";
        }
        if (empty($pwd)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "Password is required";
        }
        if ($pwd != $pwdrepeat) {
            array_push($errors, "รหัสผ่านไม่ตรงกัน");
            $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
        }

        $user_check_query = "SELECT * FROM staff WHERE username = '$username'";
        $query = mysqli_query($mysqli, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // if user exists
            if ($result['username'] === $username) {
                array_push($errors, "มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว");
            }
        }

        if (count($errors) == 0) {
            $password = md5($pwd);

            $sql = "INSERT INTO staff (stf_code, stf_name, username, passwd) VALUES ('$stfc','$stfn','$username', '$password')";
            mysqli_query($mysqli, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "คุณกำลังเข้าสู่ระบบ";
            header('location: docdb.php');
        } else {
            header("location: register2.php");
        }
    }

?>
