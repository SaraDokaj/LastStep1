<?php  
  // $emailErr="";
        

        if (isset($_POST['register']))

        {
        	require 'connection.php';
        	                         //merr te dhenat nga form
            $name    =$_POST['userNameReg'];
            $email   =$_POST['userEmailReg'];
            $password=$_POST['userPassReg'];
            $grupi   =$_POST['grupi'];        

            $allowed="fti.edu.al";

            if(empty($name)|| empty($email)|| empty($password)||empty($grupi))
            {
            	header("Location: ../student/registerstudent.php?error=emptyfiels");
            	exit();
            }

            else if(filter_var($email,FILTER_VALIDATE_EMAIL))
            {
            	$parts=explode('@', $email);//kontrollon nese emaili eshte valid dhe FTI
            	if($parts[1]!=$allowed){
                    //$emailErr="*Emaili duhet te jete i domainit @fti.edu.al.";
            		header("Location: ../student/registerstudent.php?error=invalidomain");
            	    exit();
            	}
            
            else{
            	$sql="SELECT email FROM student WHERE email=?";   //per te kontrolluar nese emaili eshte perdorur tashme
            	$stmt=mysqli_stmt_init($conn);
            	if(!mysqli_stmt_prepare($stmt,$sql))
            	{
            		header("Location: ../student/registerstudent.php?error=sqlerror");
            		exit();
            	}
            	else{
            		mysqli_stmt_bind_param($stmt,"s",$email);
            		mysqli_stmt_execute($stmt);
            		mysqli_stmt_store_result($stmt);
            		$resultCheck=mysqli_stmt_num_rows($stmt);
            		if($resultCheck > 0)
            		{
            			header("Location: ../student/registerstudent.php?error=alreadyusedemail");
            			exit();
            		}
            		else{
            			$sql="INSERT INTO student(email,emri,password,grupi) VALUES(?,?,?,?)"; //shton ne databaze
            			$stmt=mysqli_stmt_init($conn);
            			if(!mysqli_stmt_prepare($stmt,$sql))
            			{
            				header("Location: ../student/registerstudent.php?error=sqlerror");
            				exit();
            			}
            			else{
                            $hashedPwd=password_hash($password, PASSWORD_DEFAULT);
            				mysqli_stmt_bind_param($stmt,"ssss",$email,$name,$hashedPwd,$grupi);
            				mysqli_stmt_execute($stmt);
            				header("Location: ../login.php");
            				
            			}
            		}
            	}
            }
        }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        else{
        	header("Location: ../student/registerstudent.php");
        	exit();
        }
?>