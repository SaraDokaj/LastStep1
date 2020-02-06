<?php 
require 'menustudent.php'
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../styles/pedagoget.css">
</head>
<body>
<?php
//require '../includes/connection.php';

$sql="SELECT * FROM pedagog ORDER BY RAND()";
$stmt=mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
echo"<div class='container'>";
while($row=mysqli_fetch_assoc($result)) //shfaq pedagoget nga te cilet mund te zgjedhe sepse jane form
{     $sqlKerkesa= "SELECT * FROM kerkesa WHERE id_s='".$_SESSION["sesUserId"]."' AND id_p='".$row["id"]."'";
       $resultKerkesa=mysqli_query($conn,$sqlKerkesa);
       if(mysqli_num_rows($resultKerkesa)<1){
	echo "<form method='post' action='listopedagog.php'><input type='hidden' name='mentor_id' value='".$row['id']."'><input class='buton' type='submit' name='zgjidh' value='".ucwords($row['p_emri'])."  ".ucwords($row['fusha'])."'></form><br>";} //nese nuk e ka kerkuar pedagogun
	else {
		while($rreshta=mysqli_fetch_assoc($resultKerkesa))
		{
			if($rreshta['refuzuar']==0){
				echo "<form method='post' action='listopedagog.php'><input type='hidden' name='mentor_id' value='".$row['id']."'><input class='kerkuar' type='submit' name='zgjidh' value='".ucwords($row['p_emri'])."  ".ucwords($row['fusha'])."'></form><br>"; //nese tashme i ka derguar kerkese
			}
			elseif($rreshta['refuzuar']==1)
			{
				echo "<form method='post' action='listopedagog.php'><input type='hidden' name='mentor_id' value='".$row['id']."'><input class='refuzuar' type='submit' name='zgjidh' value='".ucwords($row['p_emri'])."  ".ucwords($row['fusha'])."' disabled></form><br>";//nese eshte refuzuar nga pedagogu 
			}
		}
	}
	
}

echo"</div>";

if(isset($_POST['zgjidh']))// i ben update id se mentorit
{
	require '../includes/connection.php';
	$mentor=$_POST['mentor_id'];
	
	//$sql1="UPDATE student SET mentor_id='$mentor' WHERE id=?";
	$user=$_SESSION['sesUserId'];
     $sql2="SELECT id_s FROM pranuar WHERE id_s=$user";
     $res=mysqli_query($conn,$sql2);
     $count=mysqli_num_rows($res);
             if($count==0){

	$sql1="INSERT INTO kerkesa (id_s,id_p) VALUES(?,?)";
	$stmt1=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt1,$sql1))
	{
		header("Location: listopedagog.php?error=sqlerror");
						//exit();
	}
	else{
		mysqli_stmt_bind_param($stmt1,"ii",$_SESSION['sesUserId'],$mentor);//perdor variablin e id te ruajtur ne sesion dhe id e marre permes inputit hidden 
		mysqli_stmt_execute($stmt1);
		//$_SESSION['sesUserMentor']=$mentor;
		header("location: listopedagog.php");
		exit();
	}
}


}
 mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
</body>
</html>