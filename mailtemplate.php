<!DOCTYPE html>
<html>
<head>
	<title>Verification</title>
	<style>
		#container{
			width: 800px;
			margin: 0 auto;
			height: 100px;
		}
		#header{
			background-color: grey;
			color: white;
			text-align: center
		}
		#badan{
			font-family: arial;
		}
		#kaki{
			margin-top:10px;
			background-color: grey;
			color: white;
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="container">
		<div id="header">
			<h2>EMAIL VERIFICATION BKT Tourism</h2>
		</div>
		<div id="badan">
			<p>Click the link below to verify your account</p>
			<a href="http://localhost/html/hotel_bkt/admin/pages/verifikasi.php?token=<?php echo $_GET['token']?>&user=<?php echo $_GET['user']?>">Click on this link to confirm your email</a> <!-- EDIT UNTUK HOSTING -->
		</div>
		<div id="kaki">
			<h3>end of discusion</h3>
		</div>
	</div>
</body>
</html>