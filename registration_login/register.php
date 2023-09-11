<?php 
$page_title= "Registration Form";
include('include/header.php');
include('include/navbar.php');
include('code.php');
?>

    <div class="container">
        <div class="card_body card-m">
            <form action="" method="POST" class="shadow">
                <h4 class="header2">Registration Form</h4>
                <div class="form-group mb-3">
                    <input type="text" name="username" required placeholder="Enter username">
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="email" required placeholder="Enter email">
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="name" required placeholder="Enter Name">
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" required placeholder="Enter password">
                </div>
                <input class="login" type="submit" name="signup" value="signup">
                <p>Alrady Have an Account? <a href="login.php">Login</a></p>
            </form>

        </div>
    </div>




<?php include('include/footer.php');?>