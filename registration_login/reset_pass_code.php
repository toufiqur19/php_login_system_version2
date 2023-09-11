<?php
include('database.php');
if(isset($_SESSION['login']))
{
    header ('Location: index.php') ;  

}

else
{
    $email = $_GET['email'];
    $token = $_GET['token'];
    if(isset($email)&&isset($token))
    {
        if(isset($_POST['reset']))
        {
            $chack = "SELECT * FROM `loginsystem` WHERE email = '$email' AND reset_token = '$token'";
            $result = mysqli_query($conn,$chack);
            if($result)
            {
                if(mysqli_num_rows($result)==1)
                {
                    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $fetch = mysqli_fetch_assoc($result);
                    if($fetch['reset_token']==$token)
                {
                    $update = "UPDATE `loginsystem` SET `password`='$pass',`reset_token`=NULL WHERE email = '$email'";
                    $result_up = mysqli_query($conn,$update);
                    if($result_up){
                        echo"<script> alert('your password has been changed');</script>";
                        header ("refresh:0; url=login.php");
                    }
                    else
                    {
                        echo"<script> alert('server down');</script>"; 
                    } 
                }
                }
                else
                {
                    echo"<script> alert('link expire');</script>";
                    header ("refresh:0; url=login.php"); 
                }
            }
            else
            {
                echo"<script> alert('server down');</script>";   
            }
        }
       
    }  
}
?>