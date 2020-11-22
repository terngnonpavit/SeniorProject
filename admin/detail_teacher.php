<?php
// Start the session
session_start();
if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] == False ){
    header('Location: http://localhost/seniorproject/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>CPSU</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
      <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


  </head>
  <body>
    <?php require('../navbar.php');?>

    <div class="container">
    <?php

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "test";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $id=$_GET['id'];
      $sql = "SELECT * FROM teacher WHERE `id`=$id";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $name=$row['name'];
      $teacher_code=$row['teacher_code'];
      $status=$row['status'];
      $position=$row['position'];
      $title=$row['title'];

      echo "
        <div style='margin-bottom: 20px'>
        <div class='card'>
          <div class='card-header'>
            <h4>$title$name </h4>
          </div>
          <div class='card-body'>
            <p><strong>Code:</strong> $teacher_code </p>
            <p><strong>Status:</strong> $status</p>
            <p><strong>Position:</strong> $position </p>
          </div>
          <div class='card-footer'>
          </div>
        </div>
        </div>
        ";

      $sql = "select titleTH , titleEN, author, date, type, id, file_path
            from scholarship_proceeding where author like '%".$name."%'
            UNION
            select titleTH , titleEN, author, date, type, id, file_path
            from scholarship_book where author like '%".$name."%'
            UNION
            select titleTH , titleEN, author, date, type, id, file_path
            from scholarship_journal where author like '%".$name."%'
            order by date
            ";
        $result = $conn->query($sql);

        if (isset($result->num_rows) && $result->num_rows > 0) {
            //output data of each row
            $no = 0;
            echo "<h4>Showing research for $title$name</h4>";

            while($row = $result->fetch_assoc())  {

            $titleTH=$row['titleTH'];
            $titleEN=$row['titleEN'];
            $author=$row['author'];
            $date=$row['date'];
            $type=$row['type'];
            $id=$row['id'];
            $file_path=$row['file_path'];
            // $type=$row['type'];
            // $date=$row['date'];
            $no++;

            // echo "$no  $titleTH <br />
            // $titleEN <br />
            // $author <br />
            // .................................................<br />
            // ";
            if($type=='scholarship_book'){
                echo "
                <div class='card'>
                <div class='card-header'>
                    <a class='text-success' href='detail.php/?id=$id&type=$type'><h4> $no.  $titleTH </h4></a>
                </div>
                <div class='card-body'>
                    <p><strong>title(EN):</strong> $titleEN </p>
                    <p><strong>author:</strong> $author </p>
                    <p><strong>date:</strong> $date </p>
                    <span class='badge badge-success'>Books</span>
                    <a class='text-success' href='$file_path' target='_blank'>
                        <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
                    </a>
                </div>
                </div>
                <br />
                ";
            }
            else if($type=='scholarship_journal'){
                echo "
                <div class='card'>
                <div class='card-header'>
                    <a class='text-info' href='detail.php/?id=$id&type=$type'><h4> $no.  $titleTH </h4></a>
                </div>
                <div class='card-body'>
                    <p><strong>title(EN):</strong> $titleEN </p>
                    <p><strong>author:</strong> $author </p>
                    <p><strong>date:</strong> $date </p>
                    <span class='badge badge-info'>Journals</span>
                    <a class='text-success' href='$file_path' target='_blank'>
                        <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
                    </a>
                </div>
                </div>
                <br />
                ";
            }
            else if($type=='scholarship_proceeding'){
                echo "
                <div class='card'>
                <div class='card-header'>
                    <a class='text-primary' href='detail.php/?id=$id&type=$type'><h4> $no.  $titleTH </h4></a>
                </div>
                <div class='card-body'>
                    <p><strong>title(EN):</strong> $titleEN </p>
                    <p><strong>author:</strong> $author </p>
                    <p><strong>date:</strong> $date </p>
                    <span class='badge badge-primary'>Proceedings</span>
                    <a class='text-success' href='$file_path' target='_blank'>
                        <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
                    </a>
                </div>
                </div>
                <br />
                ";
            }

            }
        } else {
            echo "No Research";
        }
    ?>



    </div>
  </body>
</html>
