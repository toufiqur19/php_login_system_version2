<?php 
$page_title= "Home page";
include('include/header.php');
include('include/navbar.php');


if(!isset($_SESSION['login']))
{
    header("location: login.php");
}
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <h4>Login And Registrations System</h4>
                <h1><?php echo $_SESSION['name']; ?></h1>
            </div>
        </div>
    </div>
</div>













<?php include('include/footer.php');?>