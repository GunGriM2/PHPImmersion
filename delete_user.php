<?php 
    session_start();
    require "functions.php";

    if (is_not_logged_in()) {
        redirect_to("page_login.php");
    } 

    $logged_user_id = $_SESSION['user']['id'];
    $edit_user_id = $_GET['id'];

    if ($_SESSION['user']['role'] !== 'admin') {
        if (!is_author($logged_user_id, $edit_user_id)) {
            set_flash_message("danger", "Редактировать можно только свой профиль.");
            redirect_to("users.php");
        }
    }

    delete($edit_user_id);

    set_flash_message("success", "Пользователь удален.");

    if (is_author($logged_user_id, $edit_user_id)){
        redirect_to("page_register.php");
    }

    redirect_to("users.php");
    
?>