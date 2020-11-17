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
  $sql = "select * from teacher";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $no = 0;
    while($row = $result->fetch_assoc())  {
      $id=$row['id'];
      $name=$row['name'];
      $teacher_code=$row['teacher_code'];
      $status=$row['status'];
      $position=$row['position'];
      $title=$row['title'];

      $no++;

      echo "
      <div class='card'>
        <div class='card-header'>
          <h4> $no. $title$name </h4>
        </div>
        <div class='card-body'>
          <p><strong>Code:</strong> $teacher_code </p>
          <p><strong>Status:</strong> $status</p>
          <p><strong>Position:</strong> $position </p>
        </div>
        <div class='card-footer'>
          <a href='http://localhost/seniorproject/admin/delete.php/?id=$id&type=teacher' class='btn btn-danger'>Delete</a>
          <a href='http://localhost/seniorproject/admin/edit_teacher.php/?id=$id' class='btn btn-warning'>Edit</a>
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
