<?php 
$page_title= "Login Form";
include('include/header.php');
include('include/navbar.php');
include('code.php');
?>
    <div class="container">
        <div class="card_body">
            <form action="" method="POST" class="shadow">
                <h4 class="header">Login Form</h4>
                <div class="form-group mb-3">
                    <input type="text" name="username" required placeholder="Enter emaill or username">
                </div>
                    
                <div class="form-group mb-2">
                    <input type="password" name="password" required placeholder="Enter password">
                </div>
                <a href="forget_password.php" id="btn">Forget Password</a>

                <input class="login" type="submit" name="login" value="Login">

                <p>Don't Have an Account? <a href="register.php">Sign Up</a></p>

            </form>
        </div>
    </div>




<?php include('include/footer.php');?>