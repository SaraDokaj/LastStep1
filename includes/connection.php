<?php 

$servername="localhost";
$dBusername="root";
$dBpassword="";
$dBname="laststep";

$conn=mysqli_connect($servername,$dBusername,$dBpassword,$dBname);


if(!$conn)
{
	die("Connection failed: ".mysqli_connection_error());
}


?>