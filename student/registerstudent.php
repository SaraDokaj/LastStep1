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

     
  	<form id="registerForm" action="../includes/registerstudent.inc.php" method="post" >
        
          <?php
        if(isset($_GET['error']))
        {
            if($_GET['error']=="invaliddomain")
                echo"<p class='error' >Duhet të përdorni një email zyrtar FTI./p>";
            if($_GET['error']=="alreadyusedemail")
                echo"<p class='error' >Ky email është regjistruar njëherë.</p>";;

        }
        ?>

         <p>
		<input  type="text" class="input"  name="userNameReg" placeholder="Emer Mbiemer" required="on">
        </p>

		<p>
		<input  type="email" class="input"  name="userEmailReg" placeholder="Email" required="on">
		<!--<span class="error"><?php //echo $emailErr ?></span>-->
        </p>

        <p>
		<input class="input" type="password" name="userPassReg" minlength="8"  placeholder="Fjalëkalim" required="on">
        </p>

        <p>
        	<!--<label for= "student">Student</label>
        	<input type="radio" name="person"  id="student">
        	<label for="pedagog">Pedagog</label>
        	<input type="radio" name="person" id="pedagog">-->
        	<input typer='text' name='grupi' placeholder='Grupi' class='input'>
        </p>

        

         <input type="submit"  name="register" class= "buton_css" value="Regjistrohu"  id="reg">
	</form>
	</section>

</body>
</html>