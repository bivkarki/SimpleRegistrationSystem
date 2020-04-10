<html>
<?php
//Database credentials
$servername="localhost";
$username="root";
$password="123456";
$database="project_db";

//Creating connection
$conn=new mysqli($servername,$username,$password,$database);
//checking connection
if($conn->connect_error)
{
die("Connection Failed".$conn->connect_error);
}
?>
</html>
