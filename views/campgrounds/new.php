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
$sql = "SELECT name, password FROM users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row["name"]==$name){
		if($row["password"]==$password){
			header("Location:views/campgrounds/index.php");
			break;
		}
	}
  }
} else {
  echo "No results";
}

/*************************CLOSE CONNECTION******************************/
$conn->close();
/***********************************************************************/
?>

<!DOCTYPE html>
<html>
	<head>
		<title>YelpCamp</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link  rel ="stylesheet" href="../../public/stylesheets/main.css">
	</head>
	<body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">YelpCamp</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if($_SESSION['logged']=="true"){
                            $currentName = $_SESSION['name'];
                            echo "
                                <li><a href='#'>Signed in as $currentName</a><li>
                                <li><a href='../../logout.php''>Logout</a><li>
                            ";
                            } else {
                            echo "
                                <li><a href='../login.php'>Login</a><li>
                                <li><a href='../register.php'>Sign Up</a><li>
                            ";
                            }

                        ?>

                    </ul>
                </div>
            </div>
        </nav>



        <div class="container">
        	<div class="row">

        		<h1 style="text-align: center;">
        			Create a New Campground!
        		</h1>
        		<div style="width:30%; margin: 25px auto;">
        			<form action="../../insertCampground.php" method="POST">
        				<div class="form-group">
        					<input class="form-control" type="text" name="name" placeholder="name" required>
        				</div>
        				<div class="form-group">
        					<input class="form-control" type="text" name="image" placeholder="image url" required>
        				</div>
        				<div class="form-group">
        					<input class="form-control" type="text" name="description" placeholder="description" required>
        				</div>
        				<div class="form-group">
        					<button class="btn btn-lg btn-success btn-block">
        						Submit!
        					</button>
        				</div>
        			</form>
        			<a href="index.php">Go Back</a>
        		</div>
        	</div>
        </div>

	</body>
</html>