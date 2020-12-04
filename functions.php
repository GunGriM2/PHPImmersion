<?php 

function get_user_by_email($email){

    $pdo = new pdo('mysql:host=localhost; dbname=my_project;', 'root', 'Mgmoioba1');

    $statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function get_user_by_id($user_id){
    
    $pdo = new pdo('mysql:host=localhost; dbname=my_project;', 'root', 'Mgmoioba1');

    $statement = $pdo->prepare("SELECT * FROM users WHERE id=:id");
    $statement->execute(['id' => $user_id]);
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

function login($email, $password){

    $user = get_user_by_email($email);

    if (empty($user)) {
        set_flash_message('danger', "Пользователь с такой почтой не найден.");
        return false;
    } elseif (!password_verify($password, $user['password'])) {
        set_flash_message('danger', "Введен неверный пароль.");
        return false;
    }
    
    return true;

}

function is_not_logged_in(){

    if (isset($_SESSION['user'])){
        return false;
    } else {
        return true;
    }

}

function edit_information($user_id, $name, $job, $phone_number, $address){

    $pdo = new pdo('mysql:host=localhost; dbname=my_project;', 'root', 'Mgmoioba1');

    $sql = "UPDATE users 
            SET name = :name,
                job = :job,
                phone_number = :phone_number,
                address = :address
            WHERE id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [   
            'name' => $name,
            'job' => $job,
            'phone_number' => $phone_number,
            'address' => $address,
            'user_id' => $user_id
        ]
    );
        
    return true;

}

function set_status($user_id, $status){

    switch ($status) {
        case 'Онлайн': 
            $status = 'success';
            break;
        case 'Отошел': 
            $status = 'warning';
            break;
        case 'Не беспокоить': 
            $status = 'danger';
            break;
    }

    $pdo = new pdo('mysql:host=localhost; dbname=my_project;', 'root', 'Mgmoioba1');

    $sql = "UPDATE users 
            SET status = :status
            WHERE id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [   
            'status' => $status,
            'user_id' => $user_id
        ]
    );

}

function upload_avatar($user_id, $image){

    $pdo = new pdo('mysql:host=localhost; dbname=my_project;', 'root', 'Mgmoioba1');

    $sql = "SELECT avatar FROM users 
            WHERE id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [   
            'user_id' => $user_id
        ]
    );
    $old_image = $statement->fetch(PDO::FETCH_ASSOC);

    if ($old_image['avatar']) {
        unlink("img/demo/avatars/{$old_image['avatar']}");
    }

    $path = $image['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION); 
    $image_name = uniqid() . "." . $ext;

    $uploadfile = 'img/demo/avatars/' . basename($image_name);
    move_uploaded_file($image['tmp_name'], $uploadfile);

    $sql = "UPDATE users 
            SET avatar = :avatar
            WHERE id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [   
            'avatar' => $image_name,
            'user_id' => $user_id
        ]
    );

}

function add_social_links($user_id, $vk_link, $telegram_link, $instagram_link){
    
    $pdo = new pdo('mysql:host=localhost; dbname=my_project;', 'root', 'Mgmoioba1');

    $sql = "UPDATE users 
            SET vk_link = :vk_link,
                telegram_link = :telegram_link,
                instagram_link = :instagram_link
            WHERE id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [   
            'vk_link' => $vk_link,
            'telegram_link' => $telegram_link,
            'instagram_link' => $instagram_link,
            'user_id' => $user_id
        ]
    );
}

function is_author($logged_user_id, $edit_user_id) {

    return ($logged_user_id == $edit_user_id) ? true : false;

}
?>
