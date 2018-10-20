
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

	$user=$_SESSION['username'];
?>
<?php
	$query="select * from productcart where username='$user'";
	$result=mysqli_query($connect,$query);
		echo "<table border=1>";
		echo "<tr>";
			echo "<th>Product id</th>";
			echo "<th>Product Name</th>";
			echo "<th>Product catagory</th>";
			echo "<th>Image</th>";
			echo "<th>Description</th>";
			echo "<th>Price</th>";
			echo "<th>Curency</th>";
			echo "<th>Quantity</th>";
			echo "<th>Total cost</th>";
			echo "<th>Cancle</th>";
			echo "<th>Order</th>";
			
		echo "</tr>";
	if($result){
		while($row = mysqli_fetch_assoc($result)){
			$i=0;
			$cart_id=$row["cartId"];
			$pro_id=$row["productId"];
			$quantity=$row["quantity"];
			$totalcost=$row["totalCost"];
			$query="select * from product where productId='$pro_id'";
			$results=mysqli_query($connect,$query);
			$rows = mysqli_fetch_assoc($results);
			$pro_name=$rows["productName"];
			$pro_cat=$rows["productCatagory"];
			$price=$rows["productPrice"];
			$image=$rows["productImage"];
			$desc=$rows["productDescription"];
			echo "<tr>";
			echo "<td><input type='hidden' name='pro_id' value='$pro_id'/>$pro_id</td>";
			echo "<td>$pro_name</td>";
			echo "<td>$pro_cat</td>";
			echo "<td class='productimage'><img src='$image'/></td>";
			echo "<td>$desc</td>";
			echo "<td><label id='price'>$price GBP</label></td>";
			echo "<td>";
			$price="<script>document.getElementById('price').value<script>";?>
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
						document.getElementById('price').innerHTML = <?php echo "$price";?>;
					}
				}
				</script>
			<?php echo "</td>";
			echo "<td>$quantity</td>";
			echo "<td>$totalcost</td>";
			echo "<td><a href='productorder.php?event=cancle&cart_id=$cart_id&pro_id=$pro_id&qty=$quantity'>Cancle</a></td>";
			echo "<td><a href='productorder.php?event=order&cart_id=$cart_id'>Order</a></td>";
			$i++;
		}
	}
	echo "</table>";

}
include_once 'footer.php';
?>