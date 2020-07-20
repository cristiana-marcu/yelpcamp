<?php
session_start();
$name="";
$image="";
$description="";
$campID=1;

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
$sql = "SELECT ID, name, image, description FROM campgrounds";
$result = $conn->query($sql);



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
        	<header class="jumbotron">
        		<div class="container">
        			<h1>Welcome to YelpCamp!</h1>
        			<p>
        				View our hand-picked campgrounds from all over the World
        			</p>
        			<p>
        			    <?php
                            if($_SESSION['logged']=="true"){
                                $currentName = $_SESSION['name'];
                                echo "
                                <a href='new.php' class='btn btn-primary btn-lg'>Add New Campground!</a>
        				        ";
        				    } else {
        				        echo "
                                <a href='../login.php' class='btn btn-primary btn-lg'>Add New Campground!</a>
                                ";
        				    }
        				?>
        			</p>
        		</div>
        	</header>

        	<div class="row text-center mygallery">
        	    <?php  if ($result->num_rows > 0) {
                         while($row = $result->fetch_assoc()) {
                           $campID = $row["ID"];
                           $name = $row["name"];
                           $image = $row["image"];
                           $description = $row["description"];
                           echo "
                           <div class='col-md-3 col-sm-6'>
                                <div class='thumbnail'>
                                    <img src=$image>
                                    <div class='caption'>
                                        <h4>$name</h4>
                                    </div>
                                    <p>
                                        <a href='show.php?ID=$campID' class='btn btn-primary'>More Info</a>
                                    </p>
                                </div>
                           </div>
                           ";
                         }

                       } else {
                         echo "No results";
                       } ?>

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