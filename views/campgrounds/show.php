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
$sqlComments = "SELECT text, users.name
                FROM ((comments
                INNER JOIN users ON comments.userID = users.ID)
                INNER JOIN campgrounds ON comments.campgroundID = campgrounds.ID)
                WHERE comments.campgroundID = $campID
                ";
$resultComments = $conn->query($sqlComments);



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
        		<div class="col-md-3">
        			<p class="lead">
        				YelpCamp
        			</p>
        			<div class="list-group">
        				<li class="list-group-item active">Info 1</li>
        				<li class="list-group-item">Info 2</li>
        				<li class="list-group-item">Info 3</li>
        			</div>
        			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d403240.0035873217!2d-119.8312959809544!3d37.85297716348046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8096f09df58aecc5%3A0x2d249c2ced8003fe!2sYosemite!5e0!3m2!1ses!2ses!4v1594729936919!5m2!1ses!2ses" width="260" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        		</div>
        		<div class="col-md-9">
        			<div class="thumbnail">
        				<img class="img-responsive" src=<?php echo $image ?>>
        				<div class="caption-full">
        					<h4 class="pull-right">
        						$9.00/night
        					</h4>
        					<h4><a href="#"><?php echo $name ?></a></h4>
        					<p>
                                <?php echo $description ?>
        					</p>
        					<?php
                                if($_SESSION['logged']=="true"){
                                    $currentName = $_SESSION['name'];
                                    echo "
                                    <a class='btn btn-warning' href='edit.php?ID=$campID'>Edit Campground</a>
                                    ";
                                } else {
                                    echo "
                                    <a class='btn btn-warning' href='../login.php?ID=$campID'>Edit Campground</a>
                                    ";
                                }
                            ?>

        				</div>
        			</div>
        			<div class="well">
        				<div class="text-right">
                            <?php
                                if($_SESSION['logged']=="true"){
                                    $currentName = $_SESSION['name'];
                                    echo "
        					            <a href='../comments/new.php?ID=$campID' class='btn btn-success'>Add New Comments</a>
        					        ";
        					    } else {
        					        echo "
                                        <a href='../login.php' class='btn btn-success'>Add New Comments</a>
                                    ";
        					    }
        					    ?>
        				</div>
        				<hr>
        				<?php

        				    if ($resultComments->num_rows > 0) {
                              while($rowComments = $resultComments->fetch_assoc()) {
                                $text = $rowComments["text"];
                                $username = $rowComments["name"];
                                echo "
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <strong>$username</strong>
                                            <span class='pull-right'>10 days ago</span>
                                            <p>
                                                $text
                                            </p>
                                        </div>
                                    </div>
                                ";
                              }

                            } else {
                              echo "No results";
                            }
        				?>

        			</div>
        		</div>
        	</div>
        </div>
        <footer class="page-footer font-small pt-4">
                  <div class="container text-center text-md-left">
                    <div class="row">
                      <hr class="clearfix w-100 d-md-none pb-3">
                        <div class="col-md-12 mt-md-0 mt-3">
                            <a href="../legal/terms.html"> Terms</a> |
                            <a href="../legal/privacy.html"> Privacy policy</a>
                        </div>
                    </div>
                  </div>
                  <div class="footer-copyright text-center py-3">© 2020 Copyright:
                    <a href="https://www.linkedin.com/in/cristiana-marcu-nicoleta/"> Cristiana Marcu</a>
                  </div>
                </footer>
	</body>
</html>