<?php

 include('menustudent.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../styles/container.css">
	<script type="text/javascript">
		function shfaq()
		{
			document.getElementById("panelNdrysho").setAttribute('style','display: block;');
		}
		function start()
		{
			document.getElementById("ndrysho").addEventListener("click",shfaq,false);
		}
        window.addEventListener("load",start,false);
		
	</script>
</head>
<body>
  <div class="containerLlogari">
  	  <img src="user.png">
  	   <div>
  	   	<label>Tema:</label> <?php
  	   	$sql="SELECT tema.titulli,student.id,tema.deadline,pedagog.emri FROM tema INNER JOIN student ON id_tema=id_t WHERE id='".$_SESSION['sesUserId']."'";
  	   	if($res=mysqli_query($conn,$sql)){
  	   	if($onerow=mysqli_fetch_assoc($res))
  	   	echo ucfirst($onerow['titulli'])."<div style='color:#FF4500;'>   " .$onerow['deadline']."</div>";
  	   
  	     }
  	     else echo "Nuk keni dorezuar akoma temen.";
  	   	?>
  	   	<br><label>Pedagogu Mentor:</label>
  	   	<?php
  	   	$sql1="SELECT pedagog.p_emri,pranuar.id_studentp, FROM pranuar INNER JOIN pedagog ON id_pedagog=pedagog.id WHERE id_studentp='".$_SESSION['sesUserId']."'";
  	   	if($res1=mysqli_query($conn,$sql1)){
  	   	if($onerow1=mysqli_fetch_assoc($res1))
  	   	echo ucwords($onerow1['p_emri']);
  	   
  	       }
  	       else echo "Nuk keni perzgjedhur akoma pedagogun mentor.";
  	   	?>
  	   	<form method="post" action="llogariastudent.php">
        <input type="submit" onclick='return confirm("A doni ta fshini llogarine perfundimisht?");' name="fshiLlogari" value="* Fshi Llogarine" class="frmbtn">
        <input type="button"  id="ndrysho" value="Ndrysho fjalekalimin" class="frmbtn">
  	    </form>
  	   </div>
  	   	 <?php
     if(isset($_POST['ndryshoPass']))
     {
     	$newPassword=$_POST['newPass'];
     	$confirmedPass=$_POST['newPassConf'];
     	if($newPassword!=$confirmedPass)
     	{
     		echo "<p style='color:#FF4500;'>Fjalekalimet duhet te perputhen.</p>";
     	}
     	else{
     		$sql="UPDATE student SET password='$newPassword' WHERE id='".$_SESSION['sesUserId']."'";
     		if(mysqli_query($conn,$sql))
     		{
     			header("location: llogariastudent.php");
     		}
     	}
     }

     if(isset($_POST['fshiLlogari']))
     {
     	$sqlDelPranuar="DELETE FROM pranuar WHERE id_studentp='".$_SESSION['sesUserId']."'";
     	 $sqlDelKerkesa="DELETE FROM kerkesa WHERE  id_s='".$_SESSION['sesUserId']."'";
     	 $sqlDelStudent="DELETE FROM student WHERE id='".$_SESSION['sesUserId']."'";

     	if( mysqli_query($conn,$sqlDelPranuar) && mysqli_query($conn,$sqlDelKerkesa))
     	{
     		mysqli_query($conn,$sqlDelStudent);
     		header("location: ../includes/logout.php");
     	}

     }
     ?>
  	</div>
  	<div  class="mesazhEkstra"  style="display:none;" id="panelNdrysho">
  		<form action="llogariastudent.php" method="post">
  			<input type="password" name="newPass" placeholder="Fjalekalimi i ri" class="inputfrm"><br>
            <input type="password" name="newPassConf" placeholder="Konfirmo fjalekalimin" class="inputfrm"><br>
            <input type="submit" name="ndryshoPass" value="Ruaj" class="frmbtn">
  		</form>
  	</div>

</body>
</html>