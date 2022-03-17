<?php 
    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "คุณต้องเข้าสู่ระบบก่อน";
        header('location: login2.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login2.php');
    }

?>
<?php
require_once("doconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    $stfc = $_POST['stfc'];
    $stfn = $_POST['stfn'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $password = md5($pass);



    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql = "INSERT 
            INTO staff (stf_code, stf_name, username, passwd) 
            VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $stfc, $stfn, $user, $password);
    $stmt->execute();

    // redirect ไปยัง actor.php
    header("location: staff.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>php db demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Add an staff</h1>
        <form action="newstaff.php" method="post">
            <div class="form-group">
                <label for="stfc">รหัสพนักงาน</label>
                <input type="text" class="form-control" name="stfc" id="stfc">
            </div>
            <div class="form-group">
                <label for="stfn">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="stfn" id="stfn">
            <div class="form-group">
                <label for="user">User Name</label>
                <input type="text" class="form-control" name="user" id="user">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="text" class="form-control" name="pass" id="pass">
            </div>
            
            <button type="submit" class="btn btn-success">Save</button>
        </form>
</body>

</html>