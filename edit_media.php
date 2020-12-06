<?php
    session_start();
    require "functions.php";

    $image = $_FILES['image'];

    $edit_user_id = $_SESSION['edit_user_id'];

    upload_avatar($edit_user_id, $image);

    set_flash_message("success", "Профиль успешно обновлен.");
    redirect_to("users.php");
?>