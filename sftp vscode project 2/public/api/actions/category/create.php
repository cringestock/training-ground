<?php 
    session_start();

    if (empty($_SESSION['user_id'])) {
        header('Location: ../login.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../../database.php';

        function INSERT_CATEGORY($user_id, $category_name, $category_type) {
            $sql = "INSERT INTO categories (user_id, name, type) VALUES (:user_id, :category_name, :category_type)";
            $stmt = pdo()->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':category_name' => $category_name,
                ':category_type' => $category_type
            ]);
        }

        $category_name = isset($_POST['category_name']) ? trim($_POST['category_name']) : '';

        if ($category_name === '') {
            die('Ошибка: Поле не должно быть пустым!');
        } else {
            echo "Данные верны: " . $category_name . '<br>';
        }

        INSERT_CATEGORY($_SESSION['user_id'], $_POST['category_name'], $_POST['category_type']);

        header('Location: ../../public/app.php');
        exit;
    }
?>