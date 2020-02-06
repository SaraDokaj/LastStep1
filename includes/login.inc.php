<?php
session_start();

if(isset($_POST['logIn']))
{
	require 'connection.php';
	$logEmail=$_POST['userEmail'];
	$logPass=$_POST['userPass'];
	$allowed="fti.edu.al";

	if(empty($logEmail)||empty($logPass))
	{
		header("Location: ../login.php?error=emptyfields");
		exit();
	}
	else{
		if(filter_var($logEmail, FILTER_VALIDATE_EMAIL))//kontrollon nese email eshte valid
		{
			$parts=explode('@',$logEmail);
			if($parts[1]!=$allowed){//kontrollin nese eshte email FTI

				header("Location: ../login.php?error=invaliddomain");
				exit();
			}
			else {
				$firstPart=explode('.',$parts[0]);
				if(strlen($firstPart[0])==1)//kontrollon nese eshte email pedagogu
				{
					$sql="SELECT * FROM pedagog WHERE p_email=?";
					$pedagog=true;
				}
					
				else {

					$sql="SELECT * FROM student WHERE email=?";//perndryshe kontrollon student
					$student=true;


				}

					$stmt=mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql))
					{
						header("Location: ../login.php?error=sqlerror");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt,"s",$logEmail);
						mysqli_stmt_execute($stmt);
						$results=mysqli_stmt_get_result($stmt);
						if($row=mysqli_fetch_assoc($results))
						{    
							$pwdCheck=password_verify($logPass,$row['password']);
							if($pwdCheck==true)
							//kontrollon nese paswordi perputhet me ate ne databaze
								//if($logPass==$row['password'])
							{

								$_SESSION['sesUserId']=$row['id'];//ruan ne sesion id qofte pedagog apo student
								if($student==true){     

									$_SESSION['sesUserName']=$row['emri'];
									$_SESSION['sesUserMentor']=$row['mentor_id'];//ruan id e mentorit per te content te ndryshem me vone 
									//*if($row['mentor_id']==NULL){
									header("Location: ../student/kreustudent.php");
									exit();}
									/*else{
										header("Location: ../student/menustudentzgjedhur.php");
									exit();
									}*/
								
								else if($pedagog==true)
								{

									$_SESSION['sesUserName']=$row['p_emri'];//ruan emrin e pedagogut ne sesion per tu printuar me pas
									header("Location: ../pedagog/menupedagog.php");
									exit();
								}


							}
							else{
								header("Location: ../login.php?error=wrongpassword");//nese paswordi nuk perputhet
								exit();
							}

						}
						else{
							header("Location: ../login.php?error=nouser");//nese nuk gjendet useri ne databazw
							exit();

						}

					}
				
			}
		}
		else 
		{
			header("Location: ../login.php?error=invalidemail");
			exit();
		}

	}
}
else{
	header("Location: ../login.php");
	exit();
}
?>