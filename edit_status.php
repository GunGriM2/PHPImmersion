<?php 
    session_start();
    require "functions.php";

    $status = $_POST['status_select']; 

    $edit_user_id = $_SESSION['edit_user_id'];

    set_status($edit_user_id, $status);
    
    set_flash_message("success", "Профиль успешно обновлен.");
    redirect_to("users.php");

?>