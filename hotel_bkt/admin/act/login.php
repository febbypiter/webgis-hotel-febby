<?php
include ('../../../connect.php');
session_start();
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$pass = md5(md5($password));

	//$pass=$password;
	$sql = mysqli_query($conn,"SELECT * FROM admin WHERE upper(username)=upper('$username') and password='$pass'");
	$dt = mysqli_fetch_array($sql);
	$num = mysqli_num_rows($sql);
	if($num==1){		
		$_SESSION['username'] = $username;

		if($dt['role']=='A'){		
			$_SESSION['A'] = true;
			?><script language="JavaScript">document.location='../'</script><?php
			echo "<script>alert (' hyyy');</script>";
		}
		if($dt['role']=='P'){
			$sql=mysqli_query($conn,"select max(stewardship_period) from admin where username='$dt[username]'");
			$dt2=mysqli_fetch_assoc($sql);
			if($dt['stewardship_period']!=$dt2['max'])
			{
			echo "<script>
			alert (' Your Period is Expired !');
			eval(\"parent.location='../login.php '\");	
			</script>";
			}
			$_SESSION['P'] = true;
			$_SESSION['username']=$dt['username'];
			$_SESSION['id']=$dt['id'];
			$_SESSION['name']=$dt['name'];
			$query=mysqli_query($conn,"select * from hotel where id='$dt[id]'");
			$data=mysqli_fetch_assoc($query);
			$_SESSION['id']=$data['id'];
			?><script language="JavaScript">document.location='../indexu.php'</script><?php
		}
		if($dt['role']=='C'){
			$_SESSION['C'] = true;
			$_SESSION['username']=$dt['username'];
			$_SESSION['id']=$dt['id'];
			$_SESSION['name']=$dt['name'];
			// $query=mysqli_query($conn,"select * from hotel where id='$dt[id]'");
			// $data=mysqli_fetch_assoc($query);
			$_SESSION['id']=$data['id'];
			?><script language="JavaScript">document.location='../../index.php'</script><?php

		}
		if($dt['role'] == null){
			echo "<script>
		alert (' Check your account email to verify !');eval(\"parent.location='../login.php '\");	</script>";
		}
	

		$result = mysqli_query($conn,"update admin set last_login = now() where username='$username'");	
	}else{
		echo "<script>
		alert (' Login Failed, Please Fill Your Username and Password Correctly !');
		eval(\"parent.location='../login.php '\");	
		</script>";
	}
}
?>