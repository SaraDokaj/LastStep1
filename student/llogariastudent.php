<?php
 include('menustudent.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../styles/container.css">
	<script type="text/javascript">
		function delete(delid)
		{
			if(confirm("A doni ta fshini llogarine tuaj?"))
			{
				window.href='llogariastudent.php?del_id='+ delid + '';
				return true;
			}
		}
	</script>
</head>
<body>
  <div class="containerLlogari">
  	  <img src="user.png">
  	   <div>
  	   	Tema: <?php
  	   	$sql="SELECT tema.titulli,student.id,tema.deadline FROM tema INNER JOIN student ON id_tema=id_t WHERE id='".$_SESSION['sesUserId']."'";
  	   	$res=mysqli_query($conn,$sql);
  	   	$onerow=mysqli_fetch_assoc($res);
  	   	echo ucfirst($onerow['titulli'])."<div style='color:#FF4500;'>   " .$onerow['deadline']."</div>";
  	   	?>
  	    <input type="button" onclick="delete" name="delete(<?php echo $onerow['id']; ?>)" value="* Fshi Llogarine" class="frmbtn">
  	   </div>
  </div>
</body>
</html>