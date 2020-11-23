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
  $sql = "select * from scholarship_book";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $no = 0;
    while($row = $result->fetch_assoc())  {
      $id=$row['id'];
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $writer_name=$row['writer_name'];
      $author=$row['author'];
      $file_path=$row['file_path'];
      $type=$row['type'];
      $check_scholarship=$row['check_scholarship'];

      $no++;
      if($check_scholarship=='true'){
        echo "
        <div class='col-md-12' style='margin-bottom: 20px'>
        <div class='card'>
          <div class='card-header'>
            <a class='text-success' href='http://localhost/seniorproject/detail.php/?id=$id&type=$type'><h4> $no.  $titleEN </h4></a>
          </div>
          <div class='card-body'>
            <p><strong>ชื่อตำรา(ไทย):</strong> $titleTH </p>
            <p><strong>ชื่อผู้เขียน:</strong> $author </p>
        ";

        if($file_path != '') {
          echo "
          <a class='text-success' href='$file_path' target='_blank'>
            <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
          </a>
          ";
        }

        echo "
        </div>
          <div class='card-footer'>
            <a href='http://localhost/seniorproject/admin/delete.php/?id=$id&type=scholarship_book' class='btn btn-danger'>Delete</a>
            <a href='http://localhost/seniorproject/admin/edit_scholarship_book.php/?id=$id' class='btn btn-warning'>Edit</a>
            <a href='http://localhost/seniorproject/report/generate_book_report.php/?id=$id&save=true' class='btn btn-dark'><i class='fas fa-print'></i>พิมพ์เอกสารขอทุน</a>
            <a href='http://localhost/seniorproject/report/generate_book_report.php/?id=$id&save=false' class='btn btn-secondary'>ดูเอกสารขอทุน</a>
          </div>
        </div>
        </div>
        ";
      }
      else{
        echo "
        <div class='col-md-12' style='margin-bottom: 20px'>
        <div class='card'>
          <div class='card-header'>
            <a class='text-success' href='http://localhost/seniorproject/detail.php/?id=$id&type=$type'><h4> $no.  $titleEN </h4></a>
          </div>
          <div class='card-body'>
            <p><strong>ชื่อตำรา(ไทย):</strong> $titleTH </p>
            <p><strong>ชื่อผู้เขียน:</strong> $author </p>
        ";

        if ($file_path != '') {
          echo "
          <a class='text-success' href='$file_path' target='_blank'>
            <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
          </a>
          ";
        }

        echo "
        </div>
          <div class='card-footer'>
            <a href='http://localhost/seniorproject/admin/delete.php/?id=$id&type=scholarship_book' class='btn btn-danger'>Delete</a>
            <a href='http://localhost/seniorproject/admin/edit_scholarship_book.php/?id=$id' class='btn btn-warning'>Edit</a>
            <a href='http://localhost/seniorproject/admin/scholarship_book.php/?id=$id' class='btn btn-secondary'>สร้างเอกสารขอทุน</a>
          </div>
        </div>
        </div>
        ";
      }
    }
  }
  else {
    echo "No Results";
  }
  $conn->close();
?>
