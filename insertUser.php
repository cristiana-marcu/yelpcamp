<?php
session_start();
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "yelpcamp";


//name and password
$name="";
$password="";

$doInsert=FALSE;

/*********************Receiving data from form***********************/
if($_POST){
	
	if(isset($_POST['name']) && isset($_POST['password']))
	{
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    }
    else{	
		include 'views/register.php';
	}
}
else{
	
	echo "Something went wrong";
	include 'views/register.php';
	
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

/************************Verify if user exists***********************/

//SQL consult
$sql = "SELECT name FROM users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	
    if(($row["name"]==$name)) {
		echo "This user already exists";
		 $doInsert=FALSE;
		
		break;
	  }
	else{
		 $doInsert=TRUE;
	}
   }
 
}
else {
  echo "No results";
  $doInsert=TRUE;
}

if($doInsert===TRUE){
	/*************************INSERT************************************/
		$sql = "INSERT INTO users (name, password)
		VALUES ('$name', '$password')";

		if ($conn->query($sql) === TRUE) {
		  header("Location:views/campgrounds/index.php");
		} else {
		  echo "Something went wrong...: " . $sql . "<br>" . $conn->error;
		}
	/*******************************************************************/
}
else{
	
	echo "Something went wrong...";
	include 'views/register.php';
}

/***********************************************************************/



/*************************CLOSE CONNECTION******************************/
$conn->close();
/***********************************************************************/
?>