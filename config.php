<?php

/* Config */

//Database Host
$db_host = 'localhost';

//Database Name
$database = 'jewellery4u';

//Database Username
$db_user = 'root';

//Database Password
$db_pass = '';

$connect = mysqli_connect($db_host, $db_user, $db_pass);
if (!$connect) die("Unable to connect to mysqli: " . mysqli_error($connect));
?>
