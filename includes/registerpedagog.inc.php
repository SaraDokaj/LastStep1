<?php  
  // $emailErr="";
        

        if (isset($_POST['registerP']))

        {
            require 'connection.php';
                                        //merr te dhenat
            $name    =$_POST['userNameP'];
            $email   =$_POST['userEmailP'];
            $password=$_POST['userPassP'];
            $fusha   =$_POST['fusha'];

            $allowed="fti.edu.al";

            if(empty($name)|| empty($email)|| empty($password)||empty($fusha))
            {
                header("Location: ../pedagog/registerpedagog.php?error=emptyfiels");
                exit();
            }

            else if(filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $parts=explode('@', $email);
                if($parts[1]!=$allowed){         
                    header("Location: ../pedagog/registerpedagog.php?error=invalidemail");
                    exit();
                }
            else{
                 $firstPart=explode('.',$parts[0]);
                if(strlen($firstPart[0])!=1)
                {
                     header("Location: ../pedagog/registerpedagog.php?error=notteacher");
                     exit();
                }
            else{
                $sql="SELECT p_email FROM pedagog WHERE p_email=?";
                $stmt=mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql))
                {
                    header("Location: ../pedagog/registerpedagog.php?error=sqlerror1");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt,"s",$email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck=mysqli_stmt_num_rows($stmt);
                    if($resultCheck > 0)
                    {
                        header("Location: ../pedagog/registerpedagog.php?error=alreadyusedemail");
                        exit();
                    }
                    else{
                        $sql="INSERT INTO pedagog(p_email,p_emri,password,fusha) VALUES(?,?,?,?)";
                        $stmt=mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql))
                        {
                            header("Location: ../pedagog/registerpedagog.php?error=sqlerror2");
                            exit();
                        }
                        else{
                            $hashedPwd=password_hash($password,PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt,"ssss",$email,$name,$hashedPwd,$fusha);
                            //mysqli_stmt_bind_param($stmt,"ssss",$email,$name,$password,$fusha);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../login.php");
                            
                        }
                    }
                }
            }
           }
        }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        else{
            header("Location: ../pedagog/registerpedagog.php");
            exit();
        }
?>