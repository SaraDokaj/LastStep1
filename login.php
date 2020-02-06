<?php
//session_start();
require ('header.php');
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		h1,h2{ 
			
			color:white;
			text-align: center;
			padding: 5px;
			font-family: 'Josefin Sans', sans-serif;
			
			opacity:0.95;
		}
	</style>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles/cssForm.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
	
</head>
<body>


	  <h1>ZBULO POTENCIALIN TËND<h1><br><h2>Rrugëtimi nis këtu</h2>

    <section class="center">
	<form  id="loginForm" action="includes/login.inc.php" method="post">
		<p>
		<input  type="email" class="input"  name="userEmail" placeholder="Email" required="on">
        </p>

        <p>
		<input class="input" type="password" name="userPass"   placeholder="Fjalëkalim" required="on">
        </p>

		<input class="buton_css" type="submit" name="logIn" value="Hyr">

         <p>
         <label> <a href="selectpage.php" id="reg"> Kliko për tu regjistuar</a></label>
         </p>

       <?php
        if(isset($_GET['error']))
        {
        	if($_GET['error']=="invaliddomain")
        		echo"<p class='error' >Nuk mund të logoheni nëse nuk jeni student i shkollës.</p>";
            if($_GET['error']=="emptyfields")
        		echo"<p class='error' >Te gjitha fushat duhet te jene te plotesuara</p>";
        	if($_GET['error']=="wrongpassword")
        		echo"<p class='error' >Fjalëkalim i pasaktë.</p>";
        	if($_GET['error']=="nouser")
        		echo"<p class='error' >Ju nuk keni llogari ju lutem regjistrohuni.</p>";

        }
        ?>

	</form>
</section>

</body>
</html> 