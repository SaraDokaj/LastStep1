<?php
require 'menupedagog.php';
require '../includes/connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">

		.njoftimContainer{
			background-color:  linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)),white;
			background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7));
			position:absolute;
			top:40%;
			left:35%;
			padding:30px;
			border-radius: 10px;
					}
		.textcontainer{
			border:none;
			color:black;
		}
		.btn{
			padding:5px;
			background:transparent;
			border-color:grey;
			border-width:thin;
			margin-top: 10px;
		}
		.btn:hover{
			color:#DC143C;
		}

		.txtarea{
			background:transparent;
			color:#DC143C;
			overflow:visible;		}



	</style>
</head>
<body>
    <div class="njoftimContainer">
    	<form action="postonjoftim.php" method="post">
    		<textarea  class="txtarea" name="njoftim" rows="10" cols="60" class="textcontainer"></textarea><br>
    		<input type="submit" class="btn" name="posto" Value="Posto">
    	</form>
    </div>
    <?php
    if(isset($_POST['posto']))
    {
    	$njoftim=$_POST['njoftim'];
    	date_default_timezone_set('Europe/Tirane');
    	$time=time();
    	$datenjoftim=date("Y-m-d H:i",$time);

    	$sql="INSERT INTO njoftim (permbajtje,autor,datenjoftim) VALUES (?,?,?)";
    	$stmt=mysqli_stmt_init($conn);
    	if(!mysqli_stmt_prepare($stmt,$sql))
    	{
    		header("Location: postonjoftim.php?error=sqlerror");
    		exit();
    	}
    	else{
    		mysqli_stmt_bind_param($stmt,"sis",$njoftim,$_SESSION['sesUserId'],$datenjoftim);
    		mysqli_stmt_execute($stmt);
              echo"<p style='color:white;'>Shtimi u be</p>";
    		header("Location: menupedagog.php");

    	}
    }
    ?>

</body>
</html>