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

      if ($position == 'หัวหน้าภาควิชา') {
        $position = "*".$position;
      }
      $no++;

      if ($status == 'Active') {
        echo "
        <div class='col-md-12' style='margin-bottom: 20px'>
        <div class='card'>
          <div class='card-header'>
            <h4><a href='http://localhost/seniorproject/admin/detail_teacher.php/?id=$id'> $no. $title$name </a></h4>
          </div>
          <div class='card-body'>
            <p><strong>รหัสอาจารย์:</strong> $teacher_code </p>
            <p><strong>ตำแหน่ง:</strong> $position </p>
            <span class='badge badge-success'>$status</span>
          </div>
          <div class='card-footer'>

            <a href='http://localhost/seniorproject/admin/edit_teacher.php/?id=$id' class='btn btn-warning'>Edit</a>
            <a href='http://localhost/seniorproject/admin/inactive_teacher.php/?id=$id&status=Inactive' class='btn btn-danger'>Inactive</a>
          </div>
        </div>
        </div>
        ";
      } else {
        echo "
        <div class='col-md-12' style='margin-bottom: 20px'>
        <div class='card'>
          <div class='card-header'>
            <h4> $no. $title$name </h4>
          </div>
          <div class='card-body'>
            <p><strong>รหัสอาจารย์:</strong> $teacher_code </p>
            <p><strong>ตำแหน่ง:</strong> $position </p>
            <span class='badge badge-danger'>$status</span>
          </div>
          <div class='card-footer'>

            <a href='http://localhost/seniorproject/admin/edit_teacher.php/?id=$id' class='btn btn-warning'>Edit</a>
            <a href='http://localhost/seniorproject/admin/inactive_teacher.php/?id=$id&status=Active' class='btn btn-success'>Active</a>
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
