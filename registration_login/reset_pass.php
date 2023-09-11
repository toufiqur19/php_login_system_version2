
<?php 
$page_title= "Reset Password";
include('include/header.php');
include('reset_pass_code.php');
?>
    <div class="container mt-5">
        <div class="card_body">
        <form action="" method="POST" class="mt-5 shadow">
            <h4 class="header2">Reset Password</h4>
            <div class="form-group mb-2">
                <input type="password" name="password" placeholder="set new password">
            </div>
            <input class="login" type="submit" name="reset" value="Reset">
        </form>
        </div>
    </div>

<?php include('include/footer.php');?>