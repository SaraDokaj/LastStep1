<?php 
require 'menupedagog.php';
?>
<style type="text/css">
  .container{
      display:flex;
      flex-direction: column;
      align-items: center;
      align-content: center;
      justify-content: center;
      align-content: center;

      border-radius: 5px;
      border-width: thin;
      flex-wrap: column;
      width: 100%;
  }
  .container td, th{
      text-align: center;
      color:white;
      border-color: white;
      border-style: solid;
      border-width: thin;
      padding: 10px;
  }
  .butonstudent{
      background: transparent;
      border-style:solid thin;
      border-color: white;
      color:white;
  }
  .innerform{
      display: inline;
  }
</style>
<?php
require '../includes/connection.php';
$output="";

$sql="SELECT kerkesa.id_s,kerkesa.id_p,kerkesa.refuzuar,student.emri,student.grupi FROM(kerkesa INNER JOIN student ON id_s=id)WHERE id_p=? AND NOT refuzuar=1";
$stmt=mysqli_stmt_init($conn);
//mysqli_stmt_prepare($stmt,$sql);
if(!mysqli_stmt_prepare($stmt,$sql))
{
  header("Location: menupedagog.php?error=sqlerror");
  exit();
}
else{
  mysqli_stmt_bind_param($stmt,"i",$_SESSION['sesUserId']);
  mysqli_stmt_execute($stmt);
  $result=mysqli_stmt_get_result($stmt);


  $output="<div class='container'><table><thead><tr><th>Emri</th><th>Grupi</th><th>Pergjigja</th><tr><tbody>";
  while($row=mysqli_fetch_assoc($result))
  {   
                         	//$sql1="SELECT emri,grupi FROM student WHERE id=?";
                         	//$stmt1=mysqli_stmt_init($conn);
                           // mysqli_stmt_prepare($stmt1,$sql1);
                            //mysqli_stmt_bind_param($stmt1,"i",$row['id_s']);
						    //mysqli_stmt_execute($stmt1);
						    //$result1=mysqli_stmt_get_result($stmt1);
						   // $row1=mysqli_fetch_assoc($result1);
     $sqlPranuar="SELECT * FROM pranuar WHERE id_studentp='".$row['id_s']."' AND id_pedagog='".$_SESSION['sesUserId']."'";
     $resultPranuar=mysqli_query($conn,$sqlPranuar);
     $count=mysqli_num_rows($resultPranuar);
     if($count>0)
     {
        $output.="<tr><td>".ucwords($row['emri'])."</td>";
        $output.="<td>".ucwords($row['grupi'])."</td>";
        $output.="<td>Pranuar</td></tr>";
    }
    else{
      $sqlPranuarTjeter="SELECT* FROM pranuar WHERE id_studentp='".$row['id_s']."'AND NOT id_pedagog='".$_SESSION['sesUserId']."'";
      $resultPranuarTjeter=mysqli_query($conn,$sqlPranuarTjeter);
      $count=mysqli_num_rows($resultPranuarTjeter);
      if($count<1)
      {
          $output.="<tr><td>".ucwords($row['emri'])."</td>";
          $output.="<td>".ucwords($row['grupi'])."</td>";
          $output.="<td><form class='innerform' method='post' action='listostudent.php'><input type='hidden' name='id_student' value='".$row['id_s']."'><input class='butonstudent' type='submit' name='prano'id='prano' value='Prano'></form><form class='innerform' method='post' action='listostudent.php'><input type='hidden' name='id_student' value='".$row['id_s']."'><input class='butonstudent'type='submit' name='refuzo' id='refuzo' value='Refuzo'></form></td><tr>";
      }
  }
}
$output.="</tbody></table></div>";
}

echo $output;
                


    if(isset($_POST['prano'])) 
    {
    	$studentipranuar=$_POST['id_student'];
    	$sql2="INSERT INTO pranuar (id_studentp,id_pedagog) VALUES(?,?)";
    	$stmt2=mysqli_stmt_init($conn);
    	if(!mysqli_stmt_prepare($stmt2,$sql2)){
    		header("location: listostudent.php?error=sqlerror");
    		exit();
    	}

    	else{  mysqli_stmt_bind_param($stmt2,"ii",$studentipranuar,$_SESSION['sesUserId']);
    	       mysqli_stmt_execute($stmt2);
    	       header("location: listostudent.php?pranuar=success");
             }
    }

    elseif(isset($_POST['refuzo']))
    {
        $studentirefuzuar=$_POST['id_student'];
    	$sql2="UPDATE kerkesa SET refuzuar='1' WHERE id_s=?";
    	$stmt2=mysqli_stmt_init($conn);
    	if(!mysqli_stmt_prepare($stmt2,$sql2)){
    		header("location: listostudent.php?error=sqlerror");
    		exit();
    	}

    	else{  mysqli_stmt_bind_param($stmt2,"i",$studentirefuzuar);
    	       mysqli_stmt_execute($stmt2);
    	       header("location: listostudent.php?update=success");
             }
    }

    mysqli_stmt_close($stmt);
   // mysqli_stmt_close($stmt1);
  
    mysqli_close($conn);

?>