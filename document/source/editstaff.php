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

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
    $id = $_POST['id'];
    $stfc = $_POST['stfc'];
    $stfn = $_POST['stfn'];

    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $pwd = mysqli_real_escape_string($mysqli, $_POST['pwd']);
    $pwdrepeat = mysqli_real_escape_string($mysqli, $_POST['pwdrepeat']);
    $password = md5($pwd);

    $sql = "UPDATE staff
            SET stf_code = ?, 
                stf_name = ?,
                username = ?,
                passwd = ?
                -- last_update = CURRENT_TIMESTAMP
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssi", $stfc, $stfn, $username, $password, $id);
    $stmt->execute();

    header("location: staff.php");
} else {
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM staff
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
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
        <h1>Edit an staff</h1>
        <form action="editstaff.php" method="post">
            <div class="form-group">
                <label for="stfc">รหัสพนักงาน</label>
                <input type="text" class="form-control" name="stfc" id="stfc" value="<?php echo $row->stf_code;?>">
            </div>
            <div class="form-group">
                <label for="stfn">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="stfn" id="stfn" value="<?php echo $row->stf_name;?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="usern" name="username" id="usern" value="<?php echo $row->username;?>">
            </div>
            <div class="form-group">
                <label for="pwd"><b>Password</b></label>
                <input type="password" class="form-control" placeholder="Password" name="pwd">
            </div>
            <div class="form-group">
                <label for="pwdrepeat"><b>Confirm Password</b></label>
                <input type="password" class="form-control" placeholder="Confirm Password" name="pwdrepeat">
            </div>
            <input type="hidden" name="id" value="<?php echo $row->id;?>">
            <button type="submit" class="btn btn-success">Update</button>
        </form>
</body>

</html>