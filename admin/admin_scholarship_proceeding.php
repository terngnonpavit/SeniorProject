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
  $sql = "select * from scholarship_proceeding";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $no = 0;
    while($row = $result->fetch_assoc())  {
      $id=$row['id'];
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $author=$row['author'];
      $conference_name=$row['conference_name'];
      $type=$row['type'];
      $file_path=$row['file_path'];

      $no++;

      echo "
      <div class='card'>
        <div class='card-header'>
          <a class='text-primary' href='http://localhost/seniorproject/detail.php/?id=$id&type=$type'><h4> $no.  $titleEN </h4></a>
        </div>
        <div class='card-body'>
          <p><strong>title(TH):</strong> $titleTH </p>
          <p><strong>Author:</strong> $author </p>
          <p><strong>Conference:</strong> $conference_name </p>
          <a class='text-success' href='$file_path' target='_blank'>
              <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
          </a>
        </div>
        <div class='card-footer'>
          <a href='http://localhost/seniorproject/admin/delete.php/?id=$id&type=scholarship_proceeding' class='btn btn-danger'>Delete</a>
          <a href='http://localhost/seniorproject/admin/edit_scholarship_proceeding.php/?id=$id' class='btn btn-warning'>Edit</a>
          <a href='http://localhost/seniorproject/report/generate_proceeding_report.php/?id=$id&save=true' class='btn btn-dark'><i class='fas fa-print'></i>พิมพ์เอกสารขอทุน</a>
          <a href='http://localhost/seniorproject/report/generate_proceeding_report.php/?id=$id&save=false' class='btn btn-secondary'>ดูเอกสารขอทุน</a>
        </div>
      </div>
      <br />
      ";
    }
  }
  else {
    echo "No Results";
  }
  $conn->close();
?>
