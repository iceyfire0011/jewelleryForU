<?php 
echo "<html><head>
		<title>JewelleryForU</title>
		<link rel='stylesheet' type='text/css' href='css/style.css'/>
	</head>
	<body>
		<div class='menu'>
			<ul>";
session_start();
if(isset($_SESSION["logged_in"])){
				echo "<li><a href='index.php'>Home</a></li>";
			if($_SESSION["catagory"]=="admin"){
				echo "
				<li><a href='productmaintenance.php'>Maintain Product</a></li>
				<li><a href='orderview.php'>View Order</a></li>";
			}
				echo "<li><a href='productview.php'>Product Showcase</a></li>
				<li><a href='showcart.php'>View Cart</a></li>
				<li><a href='about.php'>About Us</a></li>
				<li><a href='contact.php'>Contact</a></li>
				<li><a href='logout.php'>logout.php</a></li>";
}else{
	echo "
				<li><a href='about.php'>About Us</a></li>
				<li><a href='contact.php'>Contact</a></li>
				<li><a href='login.php'>login</a></li>
				<li><a href='registrationform.php'>Register</a></li>
				<li><a href='help.pdf' target='_blank'>Help</a></li>";
}
			echo "</ul>
		</div>
	<div class='main'>";