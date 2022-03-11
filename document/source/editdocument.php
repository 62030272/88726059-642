<?php
require_once("doconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
    $id = $_POST['id'];
    $dnum = $_POST['dnum'];
    $dtitle = $_POST['dtitle'];
    $dsdate = $_POST['dsdate'];
    $dtdate = $_POST['dtdate'];
    $dstatus = $_POST['dstatus'];
    $dfname = $_POST['dfname'];

    $sql = "UPDATE documents 
            SET doc_num = ?, 
                doc_title = ?,
                doc_start_date = ?,
                doc_to_date = ?,
                doc_status = ?,
                doc_file_name = ?
                -- last_update = CURRENT_TIMESTAMP
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssi", $dnum, $dtitle, $dsdate, $dtdate, $dstatus, $dfname, $id);
    $stmt->execute();

    header("location: document.php");

} else {
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM documents
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
        <h1>Edit an document</h1>
        <form action="editdocument.php" method="post">
            <div class="form-group">
                <label for="dnum">เลขที่คำสั่ง</label>
                <input type="text" class="form-control" name="dnum" id="dnum" value="<?php echo $row->doc_num;?>">
            </div>
            <div class="form-group">
                <label for="dtitle">ชื่อคำสั่ง</label>
                <input type="text" class="form-control" name="dtitle" id="dtitle" value="<?php echo $row->doc_title;?>">
            </div>
            <div class="form-group">
                <label for="dsdate">วันที่เริ่มต้นคำสั่ง</label>
                <input type="date" class="form-control" name="dsdate" id="dsdate" value="<?php echo $row->doc_start_date;?>">
            </div>
            <div class="form-group">
                <label for="dtdate">วันที่สิ้นสุด</label>
                <input type="date" class="form-control" name="dtdate" id="dtdate" value="<?php echo $row->doc_to_date;?>">
            </div>
            <div class="form-group">
                <label for="dstatus">สถานะ</label>
                <input type="text" class="form-control" name="dstatus" id="dstatus" value="<?php echo $row->doc_status;?>">
            </div>
            <div class="form-group">
                <label for="dfname">เอกสาร</label>
                <input type="file" class="form-control" name="dfname" id="dfname" value="<?php echo $row->doc_file_name;?>">
            </div>
            
            <input type="hidden" name="id" value="<?php echo $row->id;?>">
            <button type="submit" class="btn btn-success">Update</button>
        </form>
</body>

</html>