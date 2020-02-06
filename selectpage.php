<?php
require'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(styles/laptop.jpg);
	        background-size: cover;
	       
		}

		div
		{
           
			text-align: center;
			margin-top:200px;

		}

		a{  text-decoration: none;
			padding:20px;
			color: white;
			display::inline;
			background-color:linear-gradient(rgba(255,255,255,0.75),rgba(255,255,255,0.75)),#FF7F50;
			border-radius: 20px;
			margin-right: 80px;
			margin-left: 80px;  
			font-family: verdana,arial,sans-serif;
			font-size: 2em;  
			border-color:white;
			border:solid 1px;      
		}

		a:hover{color:#FF7F50;
			background-color:linear-gradient(rgba(255,255,255,0.75),rgba(255,255,255,0.75)),white;
			border-color: #FF7F50;
			border:solid 1px;

		}
	</style>
</head>
<body>

 <div>
<a href="student/registerstudent.php">Student</a>
<a href="pedagog/registerpedagog.php">Pedagog</a>
</div>
</body>
</html>