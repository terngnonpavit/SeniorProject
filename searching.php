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

$search=$_POST['search'] ;
$type=$_POST['type'] ;
//echo $type;
$sql='';
if  ($type=='ทุกประเภท')
{
  $sql = "select * from research where research_name like '%".$search."%' or researcher like '%".$search."%'";
}
else
{
  $sql = "select * from research where research_name like '%".$search."%' or researcher like '%".$search."%' and type='".$type."'";
}
//echo $sql;

$result = $conn->query($sql);
if ($result->num_rows > 0) {
   //output data of each row
   $no = 0;
  while($row = $result->fetch_assoc())  {

    $topic=$row['research_name'];
    $content=$row['researcher'];
    $no++;

    echo "$no  $topic<br />
    $content <br />
    .................................................<br />
    ";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
