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
  $sql = "select * from proceedings where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%'";
}
else
{
  $sql = "select * from proceedings where (titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%') and type='".$type."'";
}
// echo $sql."<br />";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
   //output data of each row
   $no = 0;
  while($row = $result->fetch_assoc())  {

    $titleTH=$row['titleTH'];
    $titleEN=$row['titleEN'];
    $author=$row['author'];
    $type=$row['type'];
    $date=$row['date'];
    $no++;

    echo "$no  $titleTH <br />
    $titleEN <br />
    $author <br />
    $type <br />
    $date <br />
    .................................................<br />
    ";
  }
} else {
  echo "no results";
}
$conn->close();
?>
