<?php
    session_start();

    if (!empty($_SESSION['user_id'])) {
        header('Location: /app.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            die('Заполните email и пароль');
        }

        require_once '/var/www/config/database.php';

        $stmt = pdo()->prepare("SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Успешный вход
            $_SESSION['user_id'] = $user['id'];

            // Можно перенаправить
            header('Location: /app.php');
            exit;
        } else {
            // Неверный email или пароль
            echo 'Неверный email или пароль';
        }
    }

    // if (!empty($_SESSION['user_id'])) {
    //     header('Location: front/app.php');
    //     exit;
    // } else if (empty($_SESSION['user_id'])) {
    //     header('Location: login.php');
    //     exit;
    // }

    // if ($_SERVER['REQUEST_METHOD'] === "POST") {
    //     try {
    //         $pdo = new PDO("mysql:host=$db_config[host];port=$db_config[port];dbname=$db_config[dbname];charset=utf8", $db_config['user'], $db_config['pass']);
    //         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //         function INSERT_USER($name, $email, $password):void {
    //             global $pdo;
    //             $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    //             $stmt->execute([
    //                 ':name' => $name,   
    //                 ':email' => $email,
    //                 ':password' => $password,
    //             ]);
    //         }

    //         echo $_POST['name'],' ', $_POST['email'], ' ', $_POST['password'];
    //         INSERT_USER($_POST['name'], $_POST['email'], $_POST['password']);

    //         $_SESSION['user_id'] = $pdo->lastInsertId();

    //         header('Location: front/app.php');
    //     } catch (PDOException $e) {
    //         die("Ошибка подключения: " . $e->getMessage());
    //     }
    // }
?>