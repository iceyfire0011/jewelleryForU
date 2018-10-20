<?php
include_once 'header.php';
require_once 'config.php';
	$username = $_POST["username"];
	$password = $_POST["password"];
	mysqli_select_db($connect,$database);
	$query = "select * from user where username='$username' or email='$username'";
	$result= mysqli_query($connect,$query);
	$num_result = mysqli_num_rows ($result);
	
	if ($num_result ==1) {
		$user=mysqli_fetch_array($result);
		$attempts = $user['attempts'];
		$pass = $user['password'];
		$time= $user['timeStamp'];
		$catagory= $user['catagory'];
		if ($pass == $password) {
			if ($time >time()) {
					echo "<p>Timeout</p>";
					echo "<a href = 'login.php'>Try again some time later</a>";
			}
			else {
				$query = "update user set attempts='0' where username='$username'";
				mysqli_query($connect,$query);
				$_SESSION["logged_in"] = true;
				$_SESSION["username"] = $user['username'];
				$_SESSION["email"] = $user['email'];
				$_SESSION["catagory"] = $user['catagory'];
				if($_SESSION["catagory"]=="admin"){
					header("location:index.php");
				}else{
					header("location:index.php? user=$username");
				}
			}
		}
		else {
			$attempts = $attempts + 1;
			$query = "update user set attempts='$attempts' where username='$username'";
			mysqli_query($connect,$query);
			
			if($attempts>3){
				$time = time() + (180);
				$query = "update user set timeStamp='$time' where username='$username'";
				mysqli_query($connect,$query);
			}
			if ($attempts>3) {
				echo "<h2 align='center'>Invalid Attempts more than 3 times, <a href = 'login.php'>
				Try again</a> 3 minute later!</h2>";
			}
			else{
				echo "<h2 align='center'>Invalid login</h2>";
				echo "<h2 align='center'><a href = 'login.php'>Try again</a></h2>";
			}
		}
	}
	else {
		echo "<h2 align='center'>Invalid email<br/>";
		echo "<a href = 'login.php'>Login</a> Or  <a href = 'registration.html'>Register</a> </h2>";
	}
include_once 'footer.php';
?>