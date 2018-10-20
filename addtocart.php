<?php
session_start();
if(isset($_SESSION["logged_in"])){
	require_once 'config.php';
	mysqli_select_db ($connect,$database);
	$user=$_SESSION['username'];
	if(isset($_POST)){
		$pro_id=$_POST['pro_id'];
		$quantity=$_POST['quantity'];
		$qty=$_POST['qty'];
		if($qty>$quantity){
			$query="select * from product where productId='$pro_id'";
			$result=mysqli_query($connect,$query);
			if($result){
				$row = mysqli_fetch_assoc($result);
				$pro_name=$row["productName"];
				$pro_cat=$row["productCatagory"];
				$price=$row["productPrice"];
				$image=$row["productImage"];
				$desc=$row["productDescription"];
				$qty=$row["quantity"]-$quantity;
				$query="update product set quantity=$qty where productId='$pro_id'";
				$result=mysqli_query($connect,$query);
				$totalcost=$quantity*$price;
				$query="insert into productcart
					values('','$pro_id','$user','$quantity','$totalcost')";
				$result=mysqli_query($connect,$query);
				header("location: showcart.php");
			}
		}else{
			echo "Out of stock limit. Please check your require quantity again.";
			header("location: productview.php");
		}
	}else{
		header("location: showcart.php");
	}
}
?>