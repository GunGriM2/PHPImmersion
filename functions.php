<?php 

function get_user_by_email($email){

    $pdo = new pdo('mysql:host=localhost; dbname=my_project;', 'root', 'Mgmoioba1');

    $statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function add_user($email, $password){

    $pdo = new pdo('mysql:host=localhost; dbname=my_project;', 'root', 'Mgmoioba1');

    $statement = $pdo->prepare("INSERT INTO users (id, email, password) VALUES ( NULL, :email, :password)");
    $statement->execute(
        [   
            'email' => $email, 
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]
    );
              
    return $pdo->lastInsertId();

}

function set_flash_message($name, $message){
    $_SESSION[$name] = $message;
}

function display_flash_message($name){
    if( isset($_SESSION[$name])){
        echo "<div class=\"alert alert-{$name} text dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]); 
    }       
}

function redirect_to($path){
    header("Location: {$path}");
    exit;
}
?>