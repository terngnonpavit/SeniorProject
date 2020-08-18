<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>CPSU</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <!-- file type -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body>
    <?php require('navbar.php');?>
    <div class="jumbotron jumbotron-fluid text-white" style="background-image: url(http://localhost/seniorproject/images/coverimage4.jpg); background-size: cover; height: 50%">
      <div class="container">
        <h1>CPSU Management of Lecture’s Academic publication</h1>
        <p>เว็บแอปพลิเคชันจัดการผลงานวิชาการคณาจารย์ ภาควิชาคอมพิวเตอร์ มหาวิทยาลัยศิลปากร</p>
      </div>
    </div>
    <div class="container">

      <!-- include -->
      <?php require('form.php');?>
      <br/>
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

        if(isset($_GET['search']) && isset($_GET['type']) && $_GET['search'] != ''){
          $search=$_GET['search'];
          $type=$_GET['type'];
          //echo $type;
          $sql='';
          if  ($type=='all')
          {
            $sql = "select titleTH , titleEN, author, date, type, id
                    from proceedings where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%'
                    UNION
                    select titleTH , titleEN, author, date, type, id
                    from books where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%'
                    UNION
                    select titleTH , titleEN, author, date, type, id
                    from journals where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%'
                    ";
          }
          else
          {
            $sql = "select * from ".$type." where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%'";
          }
           // echo $sql."<br />";

          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            //output data of each row
            $no = 0;
            echo "<h4>Showing results for $search</h4>";

            while($row = $result->fetch_assoc())  {

              $titleTH=$row['titleTH'];
              $titleEN=$row['titleEN'];
              $author=$row['author'];
              $date=$row['date'];
              $type=$row['type'];
              $id=$row['id'];
              // $type=$row['type'];
              // $date=$row['date'];
              $no++;

              // echo "$no  $titleTH <br />
              // $titleEN <br />
              // $author <br />
              // .................................................<br />
              // ";
              if($type=='books'){
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
                    <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
                  </div>
                </div>
                <br />
                ";
              }
              else if($type=='journals'){
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
                    <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
                  </div>
                </div>
                <br />
                ";
              }
              else if($type=='proceedings'){
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
                    <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
                  </div>
                </div>
                <br />
                ";
              }

            }
          } else {
            echo "We were unable to find results.";
          }
        }

        $conn->close();
      ?>

    </div>


  </body>
</html>
