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



//The query on campgrounds
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

//The query on comments
$sqlComments = "SELECT text, user.name, campgroundID
                FROM ((comments
                INNER JOIN users ON comments.userID = users.ID)
                INNER JOIN campgrounds ON comments.campgroundID = campgrounds.ID)
                WHERE comments.campgroundID = $campID
                ";
$resultComments = $conn->query($sqlComments);

/*************************URL*******************************************/
$formURL = "../../insertComment.php?ID=$campID";

/*************************CLOSE CONNECTION******************************/
$conn->close();
/***********************************************************************/
?>

<!DOCTYPE html>
<html>
	<head>
		<title>YelpCamp</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link  rel ="stylesheet" href="/stylesheets/main.css">
	</head>
	<body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../campgrounds/index.php">YelpCamp</a>
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
        			Add New Comment to <?php echo $name?>
        		</h1>
        		<div style="width:30%; margin: 25px auto;">
        			<form action="<?php echo $formURL?>" method="POST">
        				<div class="form-group">
        					<textarea class="form-control" name="text" rows="3" placeholder="text"></textarea>
        				</div>

        				<div class="form-group">
        					<button class="btn btn-lg btn-success btn-block">
        						Submit!
        					</button>
        				</div>
        			</form>
        			<a href="../campgrounds/index.php">Go Back</a>
        		</div>
        	</div>
        </div>
	</body>
</html>