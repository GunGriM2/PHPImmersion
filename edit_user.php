<?php
    session_start();
    require "functions.php";

    $name = $_POST['name'];
    $job = $_POST['job'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];  
    
    $edit_user_id = $_SESSION['edit_user_id'];  

    edit_information($edit_user_id, $name, $job, $phone_number, $address);

    set_flash_message("success", "Профиль успешно обновлен.");
    redirect_to("users.php");
?>