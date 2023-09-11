<?php include('code.php');
$page_title= "Forget Password";
include('include/header.php');
?>
    <div class="container mt-5">
        <div class="card_body">
        <form action="" method="POST" class="mt-5 shadow">
            <h4 class="header2">Forget Password</h4>
            <div class="form-group mb-2">
                <input type="email" name="email" placeholder="enter your email">
            </div>
            <input class="login" type="submit" name="reset" value="Reset">
        </form>
        </div>
    </div>

<?php include('include/footer.php');?>