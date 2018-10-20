
<?php
include_once 'header.php';
?>
<script type="text/javascript" src="js/currency.js"></script>
<script type="text/javascript">
function getMyRates(jData) {
if (jData == null) {
alert("There was a problem parsing search results.");
return;
}
var myval = jData.ResultSet;
var mydiv = jData.xxMyDiv;
document.getElementById(mydiv).innerHTML = myval;
}
</script>
<?php
if(isset($_SESSION["logged_in"])){
	require_once 'config.php';
	mysqli_select_db ($connect,$database);
	
	$query="select * from product";
	$result=mysqli_query($connect,$query);

	$num=mysqli_num_rows($result);

	echo "<table>";
		echo "<tr>";

			echo "<th>Product id</th>";
			echo "<th>Product Name</th>";
			echo "<th>Product catagory</th>";
			echo "<th>Image</th>";
			echo "<th>Description</th>";
			echo "<th>Price</th>";
			echo "<th>Curency</th>";
			echo "<th>Available Quantity</th>";
			echo "<th>How many piece you want to buy</th>";
			echo "<th>Add to cart</th>";
			
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
			if($qty>0){
				$i=0;
				echo "<tr>";
				echo "<form action='addtocart.php?submit=true' method='post'>";
				echo "<td><input type='hidden' name='pro_id' value='$pro_id'/>$pro_id</td>";
				echo "<td>$pro_name</td>";
				echo "<td>$pro_cat</td>";
				echo "<td class='productimage'><img src='$image'/></td>";
				echo "<td>$desc</td>";
				echo "<td><label id='price'>$price GBP</label></td>";
				echo "<td>";?>
						<select id='cur' onchange="curencyChange();">
							<option value='GBP'>UK</option>
							<option value='USD'>USA</option>
							<option value='EUR'>Europe</option>
						</select>
						<script type="text/javascript">
						function curencyChange(){
							if(document.getElementById("cur").value=="USD"){
								getExchangeRatesDiv('price','<?php echo "$price";?>','GBP','USD','true');
							}
							if(document.getElementById("cur").value=="EUR"){
								getExchangeRatesDiv('price','<?php echo "$price";?>','GBP','EUR','true');
							}
							if(document.getElementById("cur").value=="GBP"){
								document.getElementById("price").innerHTML = <?php echo "$price";?>;
							}
						}
						</script>
					</td>
				<?php
				echo "<td><input type='hidden' name='qty' value='$qty'/>$qty</td>";
				echo "<td><input type='number' name='quantity'/></td>";
				echo "<td><input type='submit' name='addtocart' value='Add to cart'/></td>";
				echo "</form></tr>";
				$i++;
			}

		}
	}
	echo "</table>";
?>
<?php }else
	echo "please login first at <a href='login.php'>login page</a>";
include_once 'footer.php';
?>
