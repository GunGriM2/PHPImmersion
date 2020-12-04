<?php
    session_start();
    require "functions.php";

    $name = $_POST['name'];
    $job = $_POST['job'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];    

    $user_id = $_SESSION['user']['id'];

    edit_information($user_id, $name, $job, $phone_number, $address);

    set_flash_message("success", "Профиль успешно обновлен.");
    redirect_to("users.php");
?>