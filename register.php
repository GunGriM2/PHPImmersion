<?php

session_start();

require "functions.php";

$email = "emailemail";
$password = "secret";

$user = get_user_by_email($email);
var_dump($user);

if (!empty($user)){
    $_SESSION['danger'] = "Этот эл. адрес уже занят другим пользователем.";
    header("Location: page_register.php");
    exit;
}

$_SESSION['success'] = "Регистрация успешна";
header("Location: page_login.php");
exit;


?>