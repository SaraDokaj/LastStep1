<?php
include 'menustudent.php';
include '../includes/connection.php';
?> 
<link rel="stylesheet" type="text/css" href="../styles/container.css">
<style type="text/css">
    textarea{
            background:transparent;
			color:#DC143C;
			overflow:visible;
		}
       .btn{
       	padding:5px;
			background:transparent;
			border-color:grey;
			border-width:thin;
			margin-top: 10px;
			       }


</style>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
   <div class="container">
	<form action="dergoteme.php" method="post" class="innercontainer">
		<textarea cols="50" rows="2"  name="tema" placeholder="Tema që dua tw trajtoj"></textarea><br>
		<input  class="btn" type="submit" name="dergo" value="Dergo">
	</form>
    </div>
</body>
</html>
<?php  
if(isset($_POST['dergo']))
{   $done=0;
	$tema=$_POST['tema'];
	$sqlTema="INSERT INTO tema (titulli) VALUES('$tema')";
	
	if(mysqli_query($conn,$sqlTema))
          {
            	$idTema=mysqli_insert_id($conn);
            	$sqlStdTeme="UPDATE student SET id_tema='$idTema' WHERE id='".$_SESSION['sesUserId']."'";
            		 if(mysqli_query($conn,$sqlStdTeme))
            		 {
            		 	header("location: ../student/dergoteme.php?insert=success");
            		 }
            		 else{
            		 	header("location: ../student/dergoteme.php?insert=error");
            		 }	

            				
            	}


}

?> 