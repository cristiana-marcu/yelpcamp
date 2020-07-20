<?php
session_start();
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "yelpcamp";


//name and password
$campID = $_GET['ID'];
$name="";
$image="";
$description="";

/*********************Receiving data from form***********************/
if($_POST){

	if(isset($_POST['name']) && isset($_POST['image']) && isset($_POST['description']))
	{
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);
		$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    }
    else{
		header("Location:views/campgrounds/index.php");
	}
}
else{

	echo "Something went wrong";
	header("Location:views/campgrounds/index.php");

}
/********************************************************************/

/************************Connection**********************************/
// Create connection
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Not connected: " . $conn->connect_error);
}
/********************************************************************/

/*************************UPDATE************************************/
$sql = "UPDATE campgrounds SET name='$name', image='$image', description='$description' WHERE ID=$campID";

if ($conn->query($sql) === TRUE) {
  header("Location:views/campgrounds/index.php");
} else {
  echo "Something went wrong...: " . $sql . "<br>" . $conn->error;
}
/*******************************************************************/

/*************************CLOSE CONNECTION******************************/
$conn->close();
/***********************************************************************/
?>