<?php
require_once 'config.php';

if($_POST){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$age=$_POST['age'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$country=$_POST['country'];
	$contactno=$_POST['contactno'];
	if($username==null){
		echo "Username is not feild up.<br/>";
	}
	if($password==null){
		echo "Password is not feild up.<br/>";
	}
	if($age==null){
		echo "Age is not feild up.<br/>";
	}
	if($email==null){
		echo "Email is not feild up.<br/>";
	}
	if($address==null){
		echo "Address is not feild up.<br/>";
	}

	if($contactno==null){
		echo "Contactno is not feild up.<br/>";
	}
	
	if($username!=null&&$password!=null&&
	$age!=null&&$email!=null&&
	$address!=null&&$country!=null&&$contactno!=null){
		$check=null;
		if(strlen($username) <5){
			$check= "Usernames must be at least 5 characters";
			echo $check."<br/>";
		}else if(preg_match("/[^a-zA-Z0-9_-]/",$username)){
			$check= "Only a-z, A-Z, 0-9, - and _ allowed in Usernames";
			echo $check."<br/>";
		}
		
		if(strlen($password) <6){
			$check= "Password must be at least 6 characters";
			echo $check."<br/>";
		}else if(!preg_match("@[A-Z]@",$password)||
		!preg_match("@[a-z]@",$password)||!preg_match("@[0-9]@",$password)){
			$check= "Passwords require one each of a-z, A-Z and 0-9";
			echo $check."<br/>";
		}
		
		if (!is_numeric($age)){
			$check= "No Age was entered";
			echo $check."<br/>";
		}else if ($age < 18 || $age > 110){
			$check= "Age must be between 18 and 110";
			echo $check."<br/>";
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$check= "The Email address is invalid";
			echo $check."<br/>";
		}

		if($country==""){
			echo "Country is not feild up.<br/>";
		}else if($country=="uk"||$country=="usa"||$country=="europe"){
			if($check==null){
				mysqli_select_db($connect,$database);

				$query="select * from user where username='$username' or email='$email'";
				$result= mysqli_query($connect,$query);
				$count= mysqli_num_rows($result);

				if (!$count){
					$query="insert into user values('$username','$password','$age',
					'$email','','','$address','$country','user','$contactno')";
					$result= mysqli_query($connect,$query);
					if (!$result){
						echo "Error:".mysqli_error($connect);
					}else {
						header("location:login.php");
					}
				}else{
					echo "User already exist.Try different username or email.
					Back to the<a href='registrationform.php'> registration page</a>";
				}
			}else{
				echo "Back to the <a href='registrationform.php'>registration page</a>";
			}
		}else{
			echo "Our services is not for your country market<br/>
			Back to the <a href='registrationform.php'>registration page</a>";
		}
	}else{
		echo "Back to the <a href='registrationform.php'>registration page</a>";
	}
}
?>