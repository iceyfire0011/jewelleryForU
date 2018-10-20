<?php
include_once 'header.php';
if(isset($_SESSION["logged_in"]))
{
	if($_SESSION["catagory"]=="admin"){
		require_once 'config.php';
		mysqli_select_db($connect,$database);

		if($_GET){
			$pro_id=$_GET['pro_id'];	
			$pro_name=$_GET['pro_name'];
			$pro_cat=$_GET['pro_cat'];
			$price=$_GET['price'];
			$image=$_GET['image'];
			$desc=$_GET['desc'];
			$qty=$_GET['qty'];
		}
		if($_POST){
			$pro_id=$_POST['pro_id'];	
			$pro_name=$_POST['pro_name'];	
			$pro_cat=$_POST['pro_cat'];	
			$price=$_POST['price'];	
			$image=$_FILES['image']['name'];
			$desc=$_POST['desc'];	
			$qty=$_POST['qty'];

			if($pro_id==null||$pro_name==null||$pro_cat==null||$price==null||$desc==null||$qty==null){
				echo "some of the fields are missing";
			}else{
				if($_FILES['image']['name']){
					//image upload
					$folder = "images/";
					
					if ((($_FILES["image"]["type"] == "image/gif")
					 || ($_FILES["image"]["type"] == "image/jpeg")
					 || ($_FILES["image"]["type"] == "image/jpg")
					 || ($_FILES["image"]["type"] == "image/pjpeg")
					 || ($_FILES["image"]["type"] == "image/x-png")
					 || ($_FILES["image"]["type"] == "image/png"))
					 && ($_FILES["image"]["size"] < 5000000)){
						move_uploaded_file($_FILES["image"]["tmp_name"] , "$folder".$_FILES["image"]["name"]);
						$query="update product set productName='$pro_name', 
						productCatagory='$pro_cat', productPrice='$price', productImage='$image',productDescription='$desc',
						quantity='$qty' where productId='$pro_id'";
						$result= mysqli_query($connect,$query);
						if(!$result){
							echo "Error: ".mysqli_error($connect);
						}else{
							echo "Product Data Edited ";
						}
					}else{
						echo "Invalid image type or size(5 MB)";
					}
					//image upload
				}else{
					$query="update product set productName='$pro_name', 
					productCatagory='$pro_cat', productPrice='$price',productDescription='$desc',
					quantity='$qty' where productId='$pro_id'";
					$result= mysqli_query($connect,$query);
					if(!$result){
						echo "Error: ".mysqli_error($connect);
					}else{
						echo "Product Data Edited ";
					}
				}
			}
		}?>
<html>
	<body>
		<form action="productedit.php" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td>Product Id</td>
					<td>:<input type="hidden" name="pro_id" value="<?php echo $pro_id;?>"/><?php echo $pro_id;?></td>
				</tr>
				<tr>
					<td>Product Name</td>
					<td>:<input type="text" name="pro_name" value="<?php echo $pro_name;?>"/></td>
				</tr>
				<tr>
					<td>Product Catagory</td>
					<td>:<input type="text" name="pro_cat"  value="<?php echo $pro_cat;?>"/></td>
				</tr>
				<tr>
					<td>Price</td>
					<td>:<input type="text" name="price" value="<?php echo $price;?>"/></td>
				</tr>
				<tr>
					<td>Product Image</td>
					<td>:<input type="file" id="p_image" name="image" value="<?php echo $price;?>"/></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>:<input type="text" name="desc" value="<?php echo $desc;?>"/></td>
				</tr>
				<tr>
					<td>Quantity</td>
					<td>:<input type="text" name="qty" value="<?php echo $qty;?>"/></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="edit" value="Edit" />
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
	}else {header("location: login.php");
		exit();
	}
}else {header("location: login.php");
	exit();
}
include_once 'footer.php';
?>