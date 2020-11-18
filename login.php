<?php
    session_start();
    require "functions.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $logged = login($email, $password);

    if (!$logged) {
        redirect_to("page_login.php");
    }

    redirect_to("users.html");

?>