<?php
include_once 'header.php';
if(isset($_SESSION["logged_in"])){
	if($_SESSION["catagory"]=="admin"){
	require_once 'config.php';
	mysqli_select_db($connect,$database);

		if($_POST){
				$pro_id=$_POST['pro_id'];
				$pro_name=$_POST['pro_name'];
				$pro_cat=$_POST['pro_cat'];
				$price=$_POST['price'];
				$image=$_FILES['image']['name'];
				$desc=$_POST['desc'];
				$qty=$_POST['qty'];
				if($pro_id==null||$pro_name==null||$pro_cat==null||$price==null||$image==null||$desc==null||$qty==null){
					echo "some of the fields are missing";
				}else{
					if($_FILES['image']){
						//image upload
						$folder = "images/";
						
						if ((($_FILES["image"]["type"] == "image/gif")
						 || ($_FILES["image"]["type"] == "image/jpeg")
						 || ($_FILES["image"]["type"] == "image/jpg")
						 || ($_FILES["image"]["type"] == "image/pjpeg")
						 || ($_FILES["image"]["type"] == "image/x-png")
						 || ($_FILES["image"]["type"] == "image/png"))
						 && ($_FILES["image"]["size"] < 50000000)){
							move_uploaded_file($_FILES["image"]["tmp_name"] , "$folder".$_FILES["image"]["name"]);
							$query="insert into product
									values('$pro_id','$pro_name','$pro_cat','$price','images/$image','$desc','$qty')";
							$result= mysqli_query($connect,$query);
							if(!$result){
								echo "Error: ".mysqli_error($connect);
							}
							else{
								echo "Product Data Inserted ";
							}

						}else{
							echo "Something wrong with image type or size(5 MB)";
						}
						//image upload
					}
				}
			
		}
		if($_GET){
			if($_GET['event']=="delete"){
				$pro_id=$_GET['pro_id'];
				$query="delete from product where productid='$pro_id'";
				$result= mysqli_query($connect,$query);
				if(!$result){
					echo "Error: ".mysql_error();
				}
				else{
					echo "Product Data Deleted ";	
				}
			}
		}
?>
		<form action="productmaintenance.php" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td><label>Product Id:</label></td>
					<td><input type="text" name="pro_id" /></td>
				</tr>
				<tr>
					<td><label>Product Name:</label></td>
					<td><input type="text" name="pro_name" /></td>
				</tr>
				<tr>
					<td><label>Product Catagory:</label></td>
					<td><input type="text" name="pro_cat" /></td>
				</tr>
				<tr>
					<td><label>Price:</label></td>
					<td><input type="number" name="price" /></td>
				</tr>
				<tr>
					<td><label>Product Image:<label></td>
					<td><input type="file" id="p_image" name="image" /></td>
				</tr>
				<tr>
					<td><label>Description:</label></td>
					<td><textarea type="text" name="desc"></textarea></td>
				</tr>
				<tr>
					<td><label>Quantity:</label></td>
					<td><input type="number" name="qty" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Add product" name="event" />
					</td>
				</tr>
			</table>
		</form>
<?php $query="select * from product";
		$result= mysqli_query($connect,$query);
		echo "<table border=1>";
			echo "<tr>";
				echo "<th>Product Id</th>";
				echo "<th>Product Name</th>";
				echo "<th>Product catagory</th>";
				echo "<th>Price</th>";
				echo "<th>Image</th>";
				echo "<th>Description</th>";
				echo "<th>Quantity</th>";
				echo "<th>Edit</th>";
				echo "<th>Delete</th>";
			echo "</tr>";
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$pro_id=$row["productId"];
				$pro_name=$row["productName"];
				$pro_cat=$row["productCatagory"];
				$price=$row["productPrice"];
				$image=$row["productImage"];
				$desc=$row["productDescription"];
				$qty=$row["quantity"];
				echo "<tr>";
					echo "<td>$pro_id</td>";
					echo "<td>$pro_name</td>";
					echo "<td>$pro_cat</td>";
					echo "<td>$price</td>";
					echo "<td class='productimage'><img src='$image'/></td>";
					echo "<td>$desc</td>";
					echo "<td>$qty</td>";
					echo "<td><a href='productedit.php?event=edit&pro_id=$pro_id&pro_name=$pro_name&pro_cat=$pro_cat&price=$price&image=$image&desc=$desc&qty=$qty'>Edit</a></td>";
					echo "<td>
						<a href='productmaintenance.php?event=delete&pro_id=$pro_id'>Delete</a>
						</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
	?>

	<?php
	}else {
		header("location: login.php");
		exit();
	}
}else {
	header("location: login.php");
	exit();
}
include_once 'footer.php';
?>