<?php
session_start();
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "yelpcamp";


//name and password
$name="";
$image="";
$description="";

$doInsert=FALSE;

/*********************Receiving data from form***********************/
if($_POST){

	if(isset($_POST['name']) && isset($_POST['image']) && isset($_POST['description']))
	{
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);
		$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    }
    else{
		header("Location:views/campgrounds/new.php");
	}
}
else{

	echo "Something went wrong";
	header("Location:views/campgrounds/new.php");

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

/************************Verify if campground exists***********************/

//SQL consult
$sql = "SELECT * FROM campgrounds";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    if(($row["name"]==$name)) {
		echo "This campground already exists";
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
		$sql = "INSERT INTO campgrounds (name, image, description)
		VALUES ('$name', '$image', '$description')";

		if ($conn->query($sql) === TRUE) {
		  header("Location:views/campgrounds/index.php");
		} else {
		  echo "Something went wrong...: " . $sql . "<br>" . $conn->error;
		}
	/*******************************************************************/
}
else{

	echo "Something went wrong...";
	header("Location:views/campgrounds/index.php");
}

/***********************************************************************/



/*************************CLOSE CONNECTION******************************/
$conn->close();
/***********************************************************************/
?>