<?php
require_once("doconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    
    $dnum = $_POST['dnum'];
    $dtitle = $_POST['dtitle'];
    $dsdate = $_POST['dsdate'];
    $dtdate = $_POST['dtdate'];
    $dstatus = $_POST['dstatus'];
    $dfname = $_POST['dfname'];

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    $target_dir = "doc_file/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $realname = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["tmp_name"]);
    $tmp_file_name = "doc_file/" . substr($_FILES["fileToUpload"]["tmp_name"],5) . ".$fileType";
    $tmp_to_load = substr($tmp_file_name,7);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $tmp_file_name);

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    //             doc_num = ?, 
    //             doc_title = ?,
    //             doc_start_date = ?,
    //             doc_to_date = ?
    //             doc_status = ?
    //             doc_file_name = ?
    $sql = "INSERT 
            INTO documents (doc_num, doc_title, doc_start_date, doc_to_date, doc_status, doc_file_name, doc_file_up) 
            VALUES (?, ?, ?, NULL, 'Active', ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $dnum, $dtitle, $dsdate, $realname, $tmp_to_load);
    $stmt->execute();

    // redirect ไปยัง actor.php
    header("location: newdocdb.php?id=".$mysqli->insert_id);
    //header("location: document.php");
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
        <h1>Add an document</h1>
        <form action="newdocument.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="dnum">เลขที่คำสั่ง</label>
                <input type="text" class="form-control" name="dnum" id="dnum">
            </div>
            <div class="form-group">
                <label for="dtitle">ชื่อคำสั่ง</label>
                <input type="text" class="form-control" name="dtitle" id="dtitle">
            </div>
            <div class="form-group">
                <label for="dsdate">วันที่เริ่มต้นคำสั่ง</label>
                <input type="date" class="form-control" name="dsdate" id="dsdate">
            </div>
            <!-- <div class="form-group">
                <label for="dtdate">วันที่สิ้นสุด</label>
                <input type="date" class="form-control" name="dtdate" id="dtdate">
            </div> -->
            <!-- <div class="form-group">
                <label for="dstatus">สถานะ</label>
                <input type="text" class="form-control" name="dstatus" id="dstatus">
            </div> -->
            <div class="form-group">
                <label for="doc_file_up">เอกสาร</label>
                <!--<input type="text" class="form-control" name="dfname" id="dfname" ><br>-->
                <input type="file"  name="fileToUpload" id="fileToUpload" accept="application/pdf" >
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
</body>

</html>