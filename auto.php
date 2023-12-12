
<?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "emppp";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    ?>
 
    <?php
        $query2 = "select * from student order by id desc limit 1";
        $result2 = mysqli_query($conn,$query2);
        $row = mysqli_fetch_array($result2);
        $last_id = $row['id'];
        if ($last_id == "")
        {
            $customer_ID = "CUS1";
        }
        else
        {
            $customer_ID = substr($last_id, 3);
            $customer_ID = intval($customer_ID);
            $customer_ID = "CUS" . ($customer_ID + 1);
        }
    ?>
 
<?php
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $stname = $_POST["stname"];
            $course = $_POST["course"];
            if (!$conn)
            {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "INSERT INTO student (id,stname,course )VALUES ('$id','$stname','$course')";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
?>
 
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="row">
    <div class="col-sm-4">
        <form action="<?php echo ($_SERVER["PHP_SELF"]);?>" method="post">
            <div align="left">
              <h3>Autono Generating in php</h3>
            </div>
            <div align="left">
             <label>Employee No</label>
            <input type="text" class="form-control" name="id" id="id" style="color: red" value="<?php echo $customer_ID; ?>" readonly>
            </div>
            <div align="left">
                <label>Employee Name</label>
                <input type="text" class="form-control" name="stname" id="stname">
            </div>
      <div align="left">
                <label>Employee Salary</label>
                <input type="text"  class="form-control" name="course" id="course">
       </div>
</br>
     <div align="left">
        <input type="submit" value="ADD">
     </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script></div>
</div>
</div>
</body>
</html>