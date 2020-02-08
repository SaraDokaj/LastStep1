<?php
 include '../includes/connection.php';
 include 'menupedagog.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../styles/container.css">
</head>
<body>
	<?php
	$sql="SELECT pranuar.id_studentp, pranuar.id_pedagog,student.id,student.emri,student.grupi,tema.titulli, student.id_tema,tema.deadline,tema.id_t,student.dorezuar From((pranuar INNER JOIN student ON pranuar.id_studentp = student.id) INNER JOIN tema ON student.id_tema = tema.id_t) WHERE pranuar.id_pedagog = '".$_SESSION['sesUserId']."'";
if($result=mysqli_query($conn,$sql))
{   
  if(mysqli_num_rows($result)>0){
  $output="<div class='container'>";
	while($row=mysqli_fetch_assoc($result))
	{  if($row['deadline']==NULL)
        {
           $output.="<div class='innercontainer'>".ucwords($row['emri'])."  Grupi ".ucwords($row['grupi'])."  ".ucfirst($row['titulli'])."<form action='deadline.php' method='post'><input type='hidden' name='id_perDate' value='".$row['id_t']."'><input type='date' name='datedorezim' class='inputfrm'><input type='submit' name='setDate' value='Datedorezimi' class='frmbtn'></form></div>";
           echo $output;

        }
        elseif($row['deadline']!=NULL)
        {
            if($row['dorezuar']==0)
            {
        	 $output.="<div class='innercontainer'>".ucwords($row['emri'])."  ".ucwords($row['grupi'])."  ".ucfirst($row['titulli'])."  ".$row['deadline']."<form action='deadline.php' method='post'><input type='hidden' name='studentDorezo' value='".$row['id']."'><input type='submit' name='dorezuar' value='Dorezuar' class='frmbtn'></form></div>";
           echo $output;
         }
         else {
               $output.="<div class='innercontainer'>".ucwords($row['emri'])."  ".ucwords($row['grupi'])."  ".ucfirst($row['titulli'])."  ".$row['deadline']."  <label style='color:#FF4500;'>Dorezuar</label></div>";
           echo $output;
         }
        }
       $output.="</div>";
	}
}
 else {
    echo"<div class='containeralert'>Nuk ka tema te percaktuara deri tani.</div>";//nese per pedagogun e loguar nuk ka studente te pranuar qe kane dorezuar temen
  }
}


if(isset($_POST['setDate']))
{
  $datedorezim=$_POST['datedorezim'];
  $idtema=$_POST['id_perDate'];
  $sql="UPDATE tema SET deadline='$datedorezim' WHERE id_t='$idtema'";
       if(mysqli_query($conn,$sql))
                 {
                  header("location: deadline.php?insert=success");
                 }
                 else{
                  header("location: deadline.php?insert=fail");
                 }  
   }

   if(isset($_POST['dorezuar']))
   {
       $idDorezuar=$_POST['studentDorezo'];
       $sql="UPDATE student SET dorezuar=1 WHERE id='$idDorezuar'";
       if(mysqli_query($conn,$sql))
                 {
                  header("location: deadline.php?dorezo=success");
                 }
                 else{
                  header("location: deadline.php?dorezo=fail");
                 } 
   }

	?>


</body>

</html>