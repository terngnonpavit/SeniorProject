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
  $sql = "select * from books";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $no = 0;
    while($row = $result->fetch_assoc())  {
      $id=$row['id'];
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $author=$row['author'];
      $date=$row['date'];
      $type=$row['type'];
      $city=$row['city'];
      $page=$row['page'];
      $publisher=$row['publisher'];
      $no++;

      echo "
      <div class='card'>
        <div class='card-header'>
          <a href='http://localhost/seniorproject/detail.php/?id=$id&type=$type'><h4> $no.  $titleTH </h4></a>
        </div>
        <div class='card-body'>
          $titleEN <br />
          $author <br />
          $date <br />
          <span class='badge badge-success'>$type</span>
        </div>
      </div>
      <br />
      ";
      // echo "
      // <div class='card'>
      //   <div class='card-body'>
      //     <p><strong>title(TH):</strong> $titleTH </p>
      //     <p><strong>title(EN):</strong> $titleEN </p>
      //     <p><strong>author:</strong> $author </p>
      //     <p><strong>date:</strong> $date </p>
      //     <p><strong>city:</strong> $city </p>
      //     <p><strong>page:</strong> $page </p>
      //     <p><strong>publisher:</strong> $publisher </p>
      //     <p><strong>type:</strong> $type </p>
      //   </div>
      // </div>
      // <br/>
      // ";
    }
  }
  else {
    echo "We were unable to find results.";
  }
  $conn->close();
?>
