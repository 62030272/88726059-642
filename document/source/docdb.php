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

<!DOCTYPE html>
<html lang="en">

<head>
    <title>หน้าค้นหาคำสั่งแต่งตั้ง</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong> <?php echo $_SESSION['username']; ?></strong></p>
        <table>
            <tr>
                <th><a href="docdb.php?logout='1'" style="color : red;">Logout</a></th>
            </tr>
        </table>
    <?php endif ?>

    <div class="container">
        <h1>หน้าค้นหาคำสั่งแต่งตั้ง  </h1>
        <h4><a href='staff.php'><span>จัดการบุคลากร |</span></a>
        <a href='document.php'><span>จัดการข้อมูลคำสั่งแต่งตั้ง</span></a></h4>
        <form action="#" method="post">
            <input type="text" name="kw" placeholder="Enter docdb name" value="">
            <input type="submit">
        </form>

        <?php
        require_once("doconfig.php");

        // ตัวแปร $_POST เป็นตัวแปรอะเรย์ของ php ที่มีค่าของข้อมูลที่โพสมาจากฟอร์ม
        // ดึงค่าที่โพสจากฟอร์มตาม name ที่กำหนดในฟอร์มมากำหนดให้ตัวแปร $kw
        // ใส่ % เพือเตรียมใช้กับ LIKE
        @$kw = "%{$_POST['kw']}%";

        // เตรียมคำสั่ง SELECT ที่ถูกต้อง(ทดสอบให้แน่ใจ)
        // ถ้าต้องการแทนที่ค่าของตัวแปร ให้แทนที่ตัวแปรด้วยเครื่องหมาย ? 
        // concat() เป็นฟังก์ชั่นสำหรับต่อข้อความ
     
        $sql = "SELECT *
                FROM documents 
                WHERE concat(doc_num, doc_title) LIKE ? 
                ORDER BY id";

        // Prepare query
        // Bind all variables to the prepared statement
        // Execute the statement
        // Get the mysqli result variable from the statement
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $kw);
        $stmt->execute();
        // Retrieves a result set from a prepared statement
        $result = $stmt->get_result();

        // num_rows เป็นจำนวนแถวที่ได้กลับคืนมา
        if ($result->num_rows == 0) {
            echo "Not found!";
        } else {
            echo "Found " . $result->num_rows . " record(s).";
            // สร้างตัวแปรเพื่อเก็บข้อความ html 
            $table = "<table class='table table-hover'>
                        <thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>เลขที่คำสั่ง</th>
                                <th scope='col'>ชื่อคำสั่ง</th>
                                <th scope='col'>วันที่เริ่มต้นคำสั่ง</th>
                                <th scope='col'>วันที่สิ้นสุด</th>
                                <th scope='col'>สถานะ</th>
                                <th scope='col'>เอกสาร</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
                        
            // 
            $i = 1; 

            // ดึงข้อมูลออกมาทีละแถว และกำหนดให้ตัวแปร row 
            while($row = $result->fetch_object()){ 
                $table.= "<tr>";
                $table.= "<td>" . $i++ . "</td>";
                $table.= "<td>$row->doc_num</td>";
                $table.= "<td>$row->doc_title</td>";
                $table.= "<td>$row->doc_start_date</td>";
                $table.= "<td>$row->doc_to_date</td>";
                $table.= "<td>$row->doc_status</td>";
                $table.= "<td><a href='doc_file/$row->doc_file_name'>$row->doc_file_name</a></td>";
                // $table.= "<td>";
                // $table.= "<a href='editactor.php?id=$row->actor_id'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>";
                // $table.= " | ";
                // $table.= "<a href='deleteactor.php?id=$row->actor_id'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>";
                // $table.= "</td>";
                $table.= "</tr>";
            }
            
            $table.= "</tbody>";
            $table.= "</table>";
            
            echo $table;
        }
        ?>
    </div>
</body>

</html>