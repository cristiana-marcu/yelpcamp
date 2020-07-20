<?php
session_start();
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "yelpcamp";

$currentName = $_SESSION['name'];
$userID = $_SESSION['userID'];
$text="";
$campID = $_GET['ID'];


/*********************Receiving data from form***********************/
if($_POST){

	if(isset($_POST['text']))
	{
		$text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
    }
    else{
        echo "Aqui me estoy quedando!!!";
		header("Location:views/comments/new.php?ID=$campID");
	}
}
else{

	echo "Something went wrong";
	header("Location:views/comments/new.php?ID=$campID");

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

/*************************INSERT************************************/
$sql = "INSERT INTO comments (userID, text, campgroundID)
VALUES ('$userID', '$text', '$campID')";

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