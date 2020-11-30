<?php
    session_start();
    require "functions.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    $image = $_FILES['image'];

    $name = $_POST['name'];
    $job = $_POST['job'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    
    $vk_link = $_POST['vk_link'];
    $telegram_link = $_POST['telegram_link'];
    $instagram_link = $_POST['instagram_link'];

    if (get_user_by_email($email)){
        set_flash_message("danger", "Этот эл. адрес уже используется.");
        redirect_to("create_user.php");
    }

    $user_id = add_user($email, $password);
    
    edit_information($user_id, $name, $job, $phone_number, $address);
    set_status($user_id, $status);
    upload_avatar($user_id, $image);
    add_social_links($user_id, $vk_link, $telegram_link, $instagram_link);

    set_flash_message("success", "Пользователь успешно добавлен.");
    redirect_to("users.php");

?>