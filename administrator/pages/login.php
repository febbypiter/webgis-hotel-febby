<?php 
session_start();
if(isset($_SESSION['A'])){
	echo"<script language='JavaScript'>document.location='index.php'</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
		      <form class="form-login" action="act/login.php" method="post">
		        <h2 class="form-login-heading" style="background:#ffd777;border-color:white">sign in now</h2>
		        <div class="login-wrap">       
                <input type="text" class="form-control" placeholder="Username" name="username" autofocus>&nbsp
                <input type="password" class="form-control" name="password" placeholder="Password">&nbsp
                <button class="btn btn-theme btn-block" type="submit" name="submit" style="background:#ffd777;border-color:white"><i class="fa fa-lock"></i> SIGN IN</button>
                <div class="registration">
                    Don't have an account yet?<br/>
                    <a class="" href="pages/register.php">
                        Create an account
                    </a>
                </div>
		            <hr>
               
		        </div>

		      </form>	  	

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="../assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../assets/img/say.png", {speed: 500});
    </script>

  </body>

<!-- Mirrored from demo.gridgum.com/templates/AdminDashboard/DashGum/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2017 13:34:16 GMT -->
</html>