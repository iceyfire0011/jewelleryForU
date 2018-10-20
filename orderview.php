<?php
include_once 'header.php';
if(isset($_SESSION["logged_in"])){
	if($_SESSION["catagory"]=="admin"){

		require_once 'config.php';
		mysqli_select_db ($connect,$database);
		$user=$_SESSION['username'];
		if($_GET){
			if($_GET['event']=="deliver"){
				$order_id=$_GET['order_id'];
				$query="update productorder set deliveredStatus='delivered' where orderId='$order_id'";
				$result= mysqli_query($connect,$query);
			}
		}
?>
<?php
		$query="select * from productorder where deliveredStatus='not delivered'";
		$result=mysqli_query($connect,$query);
		echo "<table border=1>";
		echo "<tr>";
			echo "<th>Product id</th>";
			echo "<th>Product Name</th>";
			echo "<th>Product catagory</th>";
			echo "<th>Price</th>";
			echo "<th>Image</th>";
			echo "<th>Description</th>";
			echo "<th>Quantity</th>";
			echo "<th>Total cost</th>";
			echo "<th>user</th>";
			echo "<th>Delivery Status</th>";
			echo "<th>Deliver</th>";
			
		echo "</tr>";
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$order_id=$row["orderId"];
				$pro_id=$row["productId"];
				$quantity=$row["quantity"];
				$totalcost=$row["totalCost"];
				$email=$row["email"];
				$deliverystatus=$row["deliveredStatus"];
				$query="select * from product where productId='$pro_id'";
				$results=mysqli_query($connect,$query);
				$rows = mysqli_fetch_assoc($results);
				$pro_name=$rows["productName"];
				$pro_cat=$rows["productCatagory"];
				$price=$rows["productPrice"];
				$image=$rows["productImage"];
				$desc=$rows["productDescription"];
				echo "<tr>";
				echo "<td>$pro_id</td>";
				echo "<td>$pro_name</td>";
				echo "<td>$pro_cat</td>";
				echo "<td>$price</td>";
				echo "<td class='productimage'><img src='$image'/></td>";
				echo "<td>$desc</td>";
				echo "<td>$quantity</td>";
				echo "<td>$totalcost</td>";
				echo "<td>$email</td>";
				echo "<td>$deliverystatus</td>";
				echo "<td><a href='orderview.php?event=deliver&order_id=$order_id'>deliver</a></td>";
			}
		}
		$query="select * from productorder where deliveredStatus='delivered'";
		$result=mysqli_query($connect,$query);
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$order_id=$row["orderId"];
				$pro_id=$row["productId"];
				$quantity=$row["quantity"];
				$totalcost=$row["totalCost"];
				$email=$row["email"];
				$deliverystatus=$row["deliveredStatus"];
				$query="select * from product where productId='$pro_id'";
				$results=mysqli_query($connect,$query);
				$rows = mysqli_fetch_assoc($results);
				$pro_name=$rows["productName"];
				$pro_cat=$rows["productCatagory"];
				$price=$rows["productPrice"];
				$image=$rows["productImage"];
				$desc=$rows["productDescription"];
				echo "<tr>";
				echo "<td>$pro_id</td>";
				echo "<td>$pro_name</td>";
				echo "<td>$pro_cat</td>";
				echo "<td>$price</td>";
				echo "<td class='productimage'><img src='$image'/></td>";
				echo "<td>$desc</td>";
				echo "<td>$quantity</td>";
				echo "<td>$totalcost</td>";
				echo "<td>$email</td>";
				echo "<td>$deliverystatus</td>";
				echo "<td>delivered</td>";
			}
		}
		echo "</table>";
	}else {header("location: login.php");
		exit();
	}
}else {header("location: login.php");
	exit();
}
include_once 'footer.php';
?>