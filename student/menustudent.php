<?php
require'../includes/connection.php';
 // session_start();
  require '../header.php';
  
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../styles/menu.css">
</head>
<body>
	     <header>
          <?php
    //  session_start();
    if(isset($_SESSION['sesUserId']))
    {
      echo"<a class='logout' href='../includes/logout.php'>Dil</a>";
    }
    //else
       //header("location: login.php");
    ?>
        <?php
        echo"<h3>".ucwords($_SESSION['sesUserName'])."</h3>";
        ?>
      </header>
       
            <nav>
                <ul>
                    <li><a href="kreustudent.php">Kreu</a></li>
                    <li><a href="#">Llogaria</a></li>
                    <?php  
                    //if($_SESSION['sesUserMentor']==NULL)//nuk i shfaqet opsioni nese ka zgjedhur tashme 
                       
                       $sql="SELECT * FROM pranuar WHERE id_studentp=?";
                       $stmt=mysqli_stmt_init($conn);
                       mysqli_stmt_prepare($stmt,$sql);
                       mysqli_stmt_bind_param($stmt,"i",$_SESSION['sesUserId']);
                       mysqli_stmt_execute($stmt);
                       $result=mysqli_stmt_get_result($stmt);
                       if(mysqli_num_rows($result)>0)
                       {
                           
                            echo""; 
                       }
                       else
          
                          echo "<li><a href='listopedagog.php'>Zgjidh pedagog</a></li>"; 
                    ?>
                   <?php
                      $sql2="SELECT * FROM student WHERE id='".$_SESSION['sesUserId']."'";
                    $result=mysqli_query($conn,$sql2);
                    if($result)
                   {
                      $row=mysqli_fetch_assoc($result);
                      if($row['id_tema']==NULL)
                      {
                   echo "<li><a href='dergoteme.php'>Dorezo Teme</a></li>";
                      }

                    }
                    ?>
                   <li><a href="#">Keshille</a></li>

                    
                </ul>
            </nav>
        

</body>
</html>