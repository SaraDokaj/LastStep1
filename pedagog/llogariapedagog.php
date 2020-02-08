
<?php

 include('menupedagog.php');
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
    	<form method="post" action="llogariapedagog.php">
        <input type="submit" onclick='return confirm("A doni ta fshini llogarine perfundimisht?");' name="fshiLlogari" value="* Fshi Llogarine" class="frmbtn"><br>
        <input type="button"  id="ndrysho" value="Ndrysho fjalekalimin" class="frmbtn">
  	    </form>
  	   </div>
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
     		$sql="UPDATE pedagog SET password='$newPassword' WHERE id='".$_SESSION['sesUserId']."'";
     		if(mysqli_query($conn,$sql))
     		{
     			header("location: llogariapedagog.php");
     		}
     	}
     }

     if(isset($_POST['fshiLlogari']))
     {
     	$sqlDelNjoftim="DELETE FROM njoftim WHERE autor='".$_SESSION['sesUserId']."'";
     	 $sqlDelKerkesa="DELETE FROM kerkesa WHERE  id_p='".$_SESSION['sesUserId']."'";
     	 $sqlDelPranuar="DELETE FROM pranuar WHERE id_pedagog='".$_SESSION['sesUserId']."'";
     	 $sqlDelPedagog="DELETE FROM pedagog WHERE id='".$_SESSION['sesUserId']."'";

     	if( mysqli_query($conn,$sqlDelPranuar) && mysqli_query($conn,$sqlDelKerkesa) && mysqli_query($conn,$sqlDelNjoftim))
     	{
     		mysqli_query($conn,$sqlDelPedagog);
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