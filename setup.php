<?php
    require_once 'config.php';

	$query = "DROP DATABASE if exists $database";
	$result = mysqli_query ($connect,$query);

	$query = "CREATE DATABASE $database";
	$result = mysqli_query ($connect,$query);

	mysqli_select_db ($connect,"$database");
	
	$query = "CREATE TABLE user( 
		username varchar(20),
		password varchar (20), 
		age int, 
		email varchar(40), 
		attempts int, 
		timeStamp bigint,
		address varchar (200),
		country varchar(50),
		catagory varchar(20),
		contactNo varchar(20),
		Primary Key(username)	
	)";
	$result = mysqli_query ($connect,$query);
	
	$query = "CREATE TABLE product( 
		productId varchar(20),
		productName varchar(20),
		productCatagory varchar (20), 
		productPrice float(10,2), 
		productImage varchar(400), 
		productDescription varchar(500),
		quantity int,
		Primary Key(productId)	
	)";
	$result = mysqli_query ($connect,$query);
	
	$query = "CREATE TABLE productOrder( 
		orderId int NOT NULL AUTO_INCREMENT,
		productId varchar(20),
		email varchar (40),
		deliveredStatus varchar(20), 
		date varchar(20), 
		time varchar(10),
		quantity int,
		totalCost float(10,2),
		Primary Key(orderId)
	)";
	$result = mysqli_query ($connect,$query);
	
	$query = "CREATE TABLE productCart( 
		cartId int NOT NULL AUTO_INCREMENT,
		productId varchar(20),
		username varchar (40),
		quantity int,
		totalCost float(10,2),
		Primary Key(cartId)
	)";
	$result = mysqli_query ($connect,$query);
	
	$query="insert into user	values('susan','1234',29,
	'susan@jwellery4u.com',0,0,'','uk','admin','+140123456789')";
	$result = mysqli_query ($connect,$query);
	if ($result) {
		echo "Successfully Done </br>your email :susan@jwellery4u.com </br>password:1234";
	}
	else {
		echo "Error in Somewhere...! " . mysqli_error($connect);
	}
    ?>
	<div>Now you can click <a href='login.php'>login</a></div>
