<?php
session_start();
$campID = $_GET['ID'];

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "yelpcamp";

/************************Connection**********************************/
// Create connection
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Not connected: " . $conn->connect_error);
}
/********************************************************************/



//The query
$sql = "SELECT * FROM campgrounds WHERE ID='$campID' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $campID = $row["ID"];
    $name = $row["name"];
    $image = $row["image"];
    $description = $row["description"];
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
        			Edit <?php echo "$name" ?>
        		</h1>
        		<div style="width:30%; margin: 25px auto;">
        			<form action="../../editCampground.php?ID=<?php echo $campID ?>" method="POST">
        				<div class="form-group">
        					<input class="form-control" type="text" name="name" placeholder="name" value="<?php echo $name ?>">
        				</div>
        				<div class="form-group">
        					<input class="form-control" type="text" name="image" placeholder="image url" value="<?php echo $image ?>">
        				</div>
        				<div class="form-group">
        					<input class="form-control" type="text" name="description" placeholder="description" value="<?php echo $description ?>">
        				</div>
        				<div class="form-group">
        					<button class="btn btn-lg btn-success btn-block">
        						Update!
        					</button>
        				</div>
        			</form>
        			<a href="index.php">Go back</a>
        		</div>
        	</div>
        </div>

	</body>
</html>