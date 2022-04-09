<!DOCTYPE html>
<html lang="en">

<head>
    <title>php movies demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Movie List [<a href='new_movie.html'><span class='glyphicon glyphicon-plus'></span></a>]</h1>  
        <!-- <form action="#" method="post">
            <input type="text" name="kw" placeholder="Enter movie name" value="">
            <input type="submit">
        </form> -->

        <?php
        require_once("movieconfig.php");

        // ตัวแปร $_POST เป็นตัวแปรอะเรย์ของ php ที่มีค่าของข้อมูลที่โพสมาจากฟอร์ม
        // ดึงค่าที่โพสจากฟอร์มตาม name ที่กำหนดในฟอร์มมากำหนดให้ตัวแปร $kw
        // ใส่ % เพือเตรียมใช้กับ LIKE
        @$kw = "%{$_POST['kw']}%";

        // เตรียมคำสั่ง SELECT ที่ถูกต้อง(ทดสอบให้แน่ใจ)
        // ถ้าต้องการแทนที่ค่าของตัวแปร ให้แทนที่ตัวแปรด้วยเครื่องหมาย ? 
        // concat() เป็นฟังก์ชั่นสำหรับต่อข้อความ
        $sql = "SELECT *
                FROM movies
                WHERE concat(mv_name, mv_revenue, mv_year) LIKE ? 
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
        //
        $total1 = 0; 
        // num_rows เป็นจำนวนแถวที่ได้กลับคืนมา
        if ($result->num_rows == 0) {
            echo "Not found!";
        } else {
            echo "Found " . $result->num_rows . " record(s).";
            // สร้างตัวแปรเพื่อเก็บข้อความ html 
            $table = "<table class='table table-hover'>
                        <thead>
                            <tr>
                                <th scope='col'>ปีที่ฉาย</th>
                                <th scope='col'>ชื่อภาพยนตร์</th>
                                <th scope='col'>รายได้รวม</th>
                           
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
                        
            // 
           

            // ดึงข้อมูลออกมาทีละแถว และกำหนดให้ตัวแปร row 
            while($row = $result->fetch_object()){ 
                $table.= "<tr>";
                //$table.= "<td>$row->id</td>";
                $table.= "<td>$row->mv_year</td>";
                $table.= "<td>$row->mv_name</td>";
                //$table.= "<td>$row->mv_revenue</td>";
                //$table.= "<td>"number_format($row->mv_revenue)"</td>";
                $revenue1= $row->mv_revenue;
                $revenue2= number_format($revenue1);
                $table.= "<td>$revenue2</td>";
                
                // $table.= "<td>";
                // // $table.= "<a href='editactor.php?id=$row->movies_id'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>";
                // // $table.= " | ";
                // // $table.= "<a href='deleteactor.php?id=$row->movies_id'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>";
                // $table.= "</td>";
                
                $table.= "</tr>";

                $total1 = $total1 + $row->mv_revenue;
                $total= number_format($total1);
                
            }
            $table.= "<tr>";
                $table.= "<td>รวม</td>";
                $table.= "<td></td>";
                // $total = 0;
                // for(var i = 0; i < $mv_revenue; i++) {
                //     $total += mv_revenue[i];
                // }
            
                $table.= "<td>$total</td>";

            $table.= "</tr>";

            $table.= "</tbody>";
            $table.= "</table>";
            
            echo $table;
        }
        ?>
    </div>
</body>

</html>