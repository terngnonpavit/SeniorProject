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

      $no++;

      echo "
      <div class='card'>
        <div class='card-header'>
          <a class='text-success' href='http://localhost/seniorproject/report/generate_book_report.php/?id=$id&save=false'><h4> $no.  $titleEN </h4></a>
        </div>
        <div class='card-body'>
          <p><strong>title(TH):</strong> $titleTH </p>
          <p><strong>Writer Name:</strong> $writer_name </p>
        </div>
        <div class='card-footer'>
          <a href='http://localhost/seniorproject/admin/delete.php/?id=$id&type=scholarship_book' class='btn btn-outline-danger'>Delete</a>
          <a href='http://localhost/seniorproject/admin/edit_scholarship_book.php/?id=$id' class='btn btn-outline-warning'>Edit</a>
          <a href='http://localhost/seniorproject/report/generate_book_report.php/?id=$id&save=true' class='btn btn-outline-dark'><i class='fas fa-print'></i>Print</a>
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
