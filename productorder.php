<?php
session_start();
if(isset($_SESSION["logged_in"])){
	require_once 'config.php';
	mysqli_select_db ($connect,$database);

	$user=$_SESSION['username'];
	if($_GET){
		if($_GET['event']=="cancle"){
			$cart_id=$_GET['cart_id'];
			$qty=$_GET['qty'];
			$pro_id=$_GET['pro_id'];
			$query="delete from productcart where cartId='$cart_id'";
			$result= mysqli_query($connect,$query);
			$query="select * from product where productId='$pro_id'";
			$result= mysqli_query($connect,$query);
			$row = mysqli_fetch_assoc($result);
			$quantity=$row['quantity'];
			echo $quantity;
			$qty=$quantity+$qty;
			echo $qty;
			$query="update product set quantity=$qty where productId='$pro_id'";
			$result= mysqli_query($connect,$query);
		}
	}
	if($_GET){
		if($_GET['event']=="order"){
			$cart_id=$_GET['cart_id'];
			$query="select * from productcart where cartId='$cart_id'";
			$result= mysqli_query($connect,$query);
			$row = mysqli_fetch_assoc($result);
			$pro_id=$row["productId"];
			$user=$row["username"];
			$quantity=$row["quantity"];
			$totalcost=$row["totalCost"];
			$date=date("Y-m-d");
			$time=date("h:i:sa");
			$query="select * from user where username='$user'";
			$result= mysqli_query($connect,$query);
			$row = mysqli_fetch_assoc($result);
			$email=$row["email"];
			$query="insert into productorder values(
				'','$pro_id','$email','not delivered','$date','$time','$quantity','$totalcost')";
			$result= mysqli_query($connect,$query);
			$query="delete from productcart where cartId='$cart_id'";
			$result= mysqli_query($connect,$query);
		}
	}header("location: showcart.php");
}?>