<?php
session_start();
$name="";
$password="";

/*conexión y consulta a la base de datos*/
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "yelpcamp";



/*********************Receiving data from form***********************/
if($_POST){
	
	if(isset($_POST['name'])){
		
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		if(isset($_POST['password'])) {
			$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		}    
    }
    else{
		
		echo "You have to fill in the form";
	}
}
else{
	
	echo "You have to fill in the form";
	
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



//The query
$sql = "SELECT ID, name, password FROM users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row["name"]==$name){
		if($row["password"]==$password){
		    $_SESSION['logged']="true";
		    $_SESSION['name']=$name;
		    $_SESSION['userID']=$row["ID"];
			header("Location:views/campgrounds/index.php");
			break;
		}
	}
  }
} else {
  header("Location:views/login.php");
}

/*************************CLOSE CONNECTION******************************/
$conn->close();
/***********************************************************************/
?>