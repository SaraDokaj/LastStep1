<?php
  require'../header.php';
  require'../includes/connection.php';
  
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
        if(isset($_SESSION['sesUserId']))
    {
      echo"<a class='logout' href='../includes/logout.php'>Dil</a>";
      echo"<h3>".ucwords($_SESSION['sesUserName'])."</h3>";
    }
   
    


        ?>
       

      
      </header>
            <nav>
                <ul>
                    <li><a href="llogariapedagog.php">Llogaria</a></li>
                    <li><a href="postonjoftim.php">Njoftime</a></li>
                    <li><a href="listostudent.php">Listo Studente</a></li>
                    <li><a href="deadline.php">Deadline</a></li>

                    
                </ul>
            </nav>
        

</body>
</html>