<?php
include('database.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require ("PHPMailer/Exception.php");
require ("PHPMailer/SMTP.php");
require ("PHPMailer/PHPMailer.php");

function sendmail($email, $varify_code)
{
    $mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'public.data19@gmail.com';                     //SMTP username
    $mail->Password   = 'mhhfovidiyxlqizo';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('data.cse19@gmail.com', 'Email Test');
    $mail->addAddress($email);     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Login system';
    $mail->Body    = "Click the link to varify the email address <a href='http://localhost/registration_login/veryfy.php?email=$email&varify_code=$varify_code'>Clock Here</a>";

    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
}
}


// signup section start
if(!isset($_SESSION['login']))
{
if(isset($_POST['signup']))
{   //user chack already exist in the database
    $chack = "SELECT * FROM `loginsystem` WHERE username = '$_POST[username]' or email = '$_POST[email]'";
    $result=mysqli_query($conn,$chack);

    if($result)
    {
       if(mysqli_num_rows($result)>0)
       {
        $fecth = mysqli_fetch_assoc($result);
        if($fecth['username'] == $_POST['username'])
        {
            echo "<script> alert('$_POST[username] - username name alrady taken');</script>";  
        }
        else
        {
            echo "<script> alert('$_POST[email] - email alrady register');</script>";
        }
       } 
       else
       {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // varify email start
        $varify_code = bin2hex(random_bytes(8));
       // varify email end

        $query = "INSERT INTO `loginsystem`(`username`, `email`, `name`, `password`,`varify_code`, `varify_user`) 
        VALUES ('$username','$email','$name','$password','$varify_code', '0')";
        $query_run = mysqli_query($conn, $query) && sendmail($email, $varify_code);

        if($query_run)
        {
                echo "<script>alert('account created - Please verify your email');</script>";
                header ("refresh: 0; url=login.php");
        }
        else
        {
                echo "<script>alert('account not created');</script>";
        }
       }
    }
    else
    {
        echo "<script>alert('query Faild.... 0001');</script>";
    }
}
}
else{
    header("location: index.php");
}
// signup section end


// Login section start
if(!isset($_SESSION['login']))
{
if(isset($_POST['login']))
{
    $usernmae= $_POST["username"];
    $password=$_POST["password"];
    $sql="SELECT * FROM loginsystem WHERE username='$usernmae' OR email='$usernmae' ";
    
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        if(mysqli_num_rows($result) == 1)
        {
            $fecth = mysqli_fetch_assoc($result);
            if (password_verify($_POST['password'], $fecth['password']))
            {
                if($fecth['varify_user']==1)
                {
                    $_SESSION['login'] = true;
                    $_SESSION['name'] = $fecth['name'];
                    echo"<script> alert('login successfully');</script>";
                    header ("refresh: 0; url=index.php");
                }
                else
                {
                    echo"<script> alert('user not verified Please chack your email');</script>";  
                }
            }
            else
            {
                echo"<script> alert('invalid password');</script>";   
            }
        }
        else
        {
            echo"<script> alert('user not register');</script>";
        }
    }
    else
    {
        echo"<script> alert('Query Failed... 002');</script>";
    }
}
}
else{
    header("location: index.php");
}


// reset password section start (forget_password.php)
// onno file a jodi forget password ar kaj korta cai tahola emaill.php file
// (phpmailer) ar frist 6 line (use=3 or require=3 line) add korta hoba
// akhana add kortaci na karon ai file ar upora add kora asa
function sendemail($email, $reset_token)
{
    $mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'public.data19@gmail.com';                     //SMTP username
    $mail->Password   = 'mhhfovidiyxlqizo';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('public.data19@gmail.com', 'Email Test');
    $mail->addAddress($email);     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'reset password link form your gmail';
    $mail->Body    = "Click the link to reset your password <a href='http://localhost/registration_login/reset_pass.php?email=$email&token=$reset_token'>Reset Password</a>";

    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
}
}

if(isset($_SESSION['login']))
{
    header ('Location: index.php') ;  

}
else
{
    if(isset($_POST['reset']))
    {
        $email = $_POST['email'];
        $chack = "SELECT * FROM `loginsystem` WHERE email = '$email'";
        $result = mysqli_query($conn,$chack);

        if($result)
        {
            $reset_token = bin2hex(random_bytes(10));
            if(mysqli_num_rows($result)==1)
            {
                $update = "UPDATE `loginsystem` SET `reset_token`='$reset_token' WHERE email = '$email'";
                $update_query = mysqli_query($conn, $update)&&sendemail($email, $reset_token);
                if($update_query)
                {
                    echo"<script> alert('reset password link sent to your email');</script>";  
                }
                else
                {
                    echo"<script> alert('server down 000');</script>";  
                }
            }
            else
            {
                echo"<script> alert('user not register');</script>";  
            }
        }
        else
        {
            echo"<script> alert('server down');</script>";
        }
    }
}
// reset password section end (forget_password.php)

// reset password section start (reset_pass.php)

// reset password section end (reset_pass.php)
?>