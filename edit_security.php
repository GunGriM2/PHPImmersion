<?php
    session_start();
    require "functions.php";

    $email = $_POST['email'];
    $password = $_POST['password'];    

    $edit_user_id = $_SESSION['edit_user_id'];

    if ( get_user_by_email($email) and (get_user_by_email($email)['id'] != $edit_user_id) ) {
        set_flash_message("danger", "Этот эл. адрес уже используется.");
        redirect_to("security.php?id={$edit_user_id}");
    }

    edit_credentials($edit_user_id, $email, $password);

    set_flash_message("success", "Профиль успешно обновлен.");
    redirect_to("users.php");
?>