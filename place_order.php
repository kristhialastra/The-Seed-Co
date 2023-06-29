<?php
session_start();
require_once 'components/connection.php';

if (isset($_POST['place_order'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Place the order logic here
        // ...

        header('Location: order.php');
    } else {
        // Save the cart items in a session variable
        $_SESSION['guest_order'] = $_POST;

        // Redirect to the login page
        header('Location: login.php');
    }
}
?>
