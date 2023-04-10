<?php 
// session_start();
?>

<?php
require 'includes/header.php'; 
if (isset($_SESSION['auth']))
{
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    unset($_SESSION['cart_id']);
    unset($_SESSION['cart_count']);

    header('location:login.php');
    $_SESSION['message'] = "Logout succesfully";
}
// require 'includes/footer.php'; 
?>