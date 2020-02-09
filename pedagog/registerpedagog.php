<?php
require'../header.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../styles/cssForm.css">
  
</head>
<body>

<section class="center">
     
  	<form id="registerForm" action="../includes/registerpedagog.inc.php" method="post">
        <?php
        if(isset($_GET['error']))
        {
            if($_GET['error']=="invaliddomain")
                echo"<p class='error' >Duhet të përdorni një email zyrtar FTI./p>";
            if($_GET['error']=="alreadyusedemail")
                echo"<p class='error' >Ky email është regjistruar njëherë.</p>";
                if($_GET['error']=="notteacher")
                echo"<p class='error' >Emaili juaj nuk eshte i nje pedagogu.</p>";

        }
        ?>
         <p>
		<input  type="text" class="input"  name="userNameP" placeholder="Emer Mbiemer" required="on">
        </p>

		<p>
		<input  type="email" class="input"  name="userEmailP" placeholder="Email " required="on">
   <!-- <span class="error"><?php //echo $emailErr ?></span> -->
        </p>

        <p>
		<input class="input" type="password" name="userPassP" minlength="8"  placeholder="Fjalëkalim" required="on">
        </p>

        <p>
        	
        	<input typer='text' name='fusha' placeholder='Fusha e specializimit' class='input'>
        </p>

        <p id="extra"></p>

         <input type="submit"  name="registerP" class= "buton_css" value="Regjistrohu"  id="register">
	</form>
	</section>

</body>
</html>