<?php
include('database.php');

$email = $_GET['email'];
$varify_code = $_GET['varify_code'];


if(isset($email)&&isset($varify_code))
{
    $chack = "SELECT * FROM `loginsystem` WHERE email = '$email' AND varify_code = '$varify_code' ";

    $result = mysqli_query($conn, $chack);

    if($result){
        if(mysqli_num_rows($result)==1)
        {
            $fetch = mysqli_fetch_assoc($result);
            if($fetch['varify_user']==0)
            {
                $update = "UPDATE `loginsystem` SET `varify_user`='1' WHERE email = '$fetch[email]'";
                if(mysqli_query($conn,$update))
                {
                    echo '<script>alert("Email Verify now you can login")</script>';
                    
                    header("refresh:0; url=login.php");
                }
                else{
                    echo '<script>alert("server down")</script>';
                }
            }
            else
            {
                echo '<script>alert("Email Alrady Verify")</script>';
                header("refresh:0; url=login.php");
            }
        }
    }
    else{
        echo '<script>alert("server down")</script>';
    }
}


?>