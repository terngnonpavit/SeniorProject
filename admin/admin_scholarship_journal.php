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
  $sql = "select * from scholarship_journal";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $no = 0;
    while($row = $result->fetch_assoc())  {
      $id=$row['id'];
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];

      $no++;

      echo "
      <div class='card'>
        <div class='card-header'>
          <a class='text-info' href='http://localhost/seniorproject/report/generate_journal_report.php/?id=$id&save=false'><h4> $no.  $titleTH </h4></a>
        </div>
        <div class='card-body'>
          <p><strong>title(EN):</strong> $titleEN </p>
        </div>
        <div class='card-footer'>
          <a href='http://localhost/seniorproject/admin/delete.php/?id=$id&type=scholarship_journal' class='btn btn-outline-danger'>Delete</a>
          <a href='http://localhost/seniorproject/admin/edit_scholarship_journal.php/?id=$id' class='btn btn-outline-warning'>Edit</a>
          <a href='http://localhost/seniorproject/report/generate_journal_report.php/?id=$id&save=true' class='btn btn-outline-dark'><i class='fas fa-print'></i>Print</a>
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
