<?php
include'menustudent.php';
//include '../includes/connection.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../styles/container.css">

	<style type="text/css">
	
		.permbajtja{
			color:#DC143C;
			font-size:0.9em;
		}
		.quote{
			color:#A9A9A9;
		}
	
		
	</style>
</head>
<body>
	<?php

$sql="SELECT njoftim.permbajtje,njoftim.datenjoftim, njoftim.autor, pedagog.p_emri FROM ((pranuar INNER JOIN njoftim ON pranuar.id_pedagog=njoftim.autor)INNER JOIN pedagog ON njoftim.autor=pedagog.id) WHERE pranuar.id_studentp='".$_SESSION['sesUserId']."'";
     
     if($result=mysqli_query($conn,$sql)){
     $count=mysqli_num_rows($result);
     $paraqitja="<div class='container'>";

     if($count>0)
     {
     	while($row=mysqli_fetch_assoc($result))
     	{  $paraqitja.="<div class='innercontainer'><p class='permbajtja'>".ucwords($row['permbajtje'])."</p><br>"."<p class='quote'>".ucwords($row['p_emri'])."  ".$row['datenjoftim']."</p></div>";

     	}
     	$paraqitja.="</div>";
     	echo $paraqitja;

     }
     else {echo"<div class='containeralert'>Nuk ka njoftime nga pedagogu mentor deri tani.</div>";
         }
 }
     ?>
</body>
</html>
