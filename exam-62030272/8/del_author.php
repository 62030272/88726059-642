<?php
require_once("authorconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
    // ดึงค่าที่โพสจากฟอร์มตาม name ที่กำหนดในฟอร์มมากำหนดให้ตัวแปร $id
    $id = $_POST['authorID'];

    // เตรียมคำสั่ง DELETE
    $sql = "DELETE 
            FROM author 
            WHERE authorID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    // redirect ไปยังหน้า actor.php
    header("location: show_author.html");
} else {
    // ดึงค่าที่ส่งผ่านมาทาง query string มากำหนดให้ตัวแปร $id
    $id = $_GET['authorID'];
    $sql = "SELECT *
            FROM author
            WHERE authorID = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>author</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Delete an author</h1>
        <table class="table table-hover">
            <tr>
                <th style='width:120px'>รหัสผู้แต่ง</th>
                <td><?php echo $row->authorID;?></td>
            </tr>
            <tr>
                <th>ชื่อผู้แต่ง</th>
                <td><?php echo $row->author;?></td>
            </tr>
            <tr>
                <th>นามปากกา</th>
                <td><?php echo $row->penname;?></td>
            </tr>
            
        </table>
        <form action="del_author.php" method="post">
            <input type="hidden" name="authorID" value="<?php echo $row->authorID;?>">
            <input type="submit" value="Confirm delete" class="btn btn-danger">
            <button type="button" class="btn btn-warning" onClick="window.history.back()">Cancel Delete</button>
        </form>
</body>

</html>