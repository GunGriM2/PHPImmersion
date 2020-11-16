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
    $statement->execute([   
                            'email' => $email, 
                            'password' => password_hash($password, PASSWORD_DEFAULT)
                        ]);

    $user = get_user_by_email($email);                    
    return $user['id'];

}

?>
