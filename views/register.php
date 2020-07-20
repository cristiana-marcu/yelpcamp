<?php
session_start();
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
                    <a class="navbar-brand" href="campgrounds/index.php">YelpCamp</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if($_SESSION['logged']=="true"){
                            $currentName = $_SESSION['name'];
                            echo "
                                <li><a href='#'>Signed in as $currentName</a><li>
                                <li><a href='../logout.php''>Logout</a><li>
                            ";
                            } else {
                            echo "
                                <li><a href='login.php'>Login</a><li>
                                <li><a href='register.php'>Sign Up</a><li>
                            ";
                            }

                        ?>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="row">
                <div class="col"></div>
                    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2">
                        <div class="card shadow border-0">
                          <div class="card-body">
                            <h1 class="text-center">Sign Up!</h1>
                            <form class="needs-validation" action="../insertUser.php" method="POST" novalidate>
                              <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="name" class="form-control" id="exampleInputUsername" placeholder="Username" required>
                                <div class="invalid-feedback">
                                  Please enter your username
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                                <div class="invalid-feedback">
                                  Please enter your password
                                </div>
                              </div>
                              <button type="submit" class="btn btn-success btn-block">Register</button>
                            </form>
                          </div>
                    </div>
                </div>
                <div class="col"> </div>
            </div>
        </div>
	</body>
</html>