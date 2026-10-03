<?php
    session_start();

    if (empty($_SESSION['user_id'])) {
        header('Location: ../../../signin.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../../../config/database.php';

        function INSERT_TRANSACTION($date, $amount, $description, $category_id, $type): void {
            $sql = "INSERT INTO operations (date, amount, description, category_id, type, user_id) VALUES (:date, :amount, :description, :category_id, :type, :user_id)";
            $stmt = pdo()->prepare($sql);
            $stmt->execute([
                ':date'         => $date,   
                ':amount'       => $amount,
                ':description'  => $description,
                ':category_id'  => 3,
                ':type'         => $type,
                ':user_id'      => $_SESSION['user_id']
            ]);
        }

        function checkDateString($date, $format = 'Y-m-d') {
            $parsed = DateTime::createFromFormat($format, $date);
            
            // Если PHP не смог создать объект, дата точно неверна
            if ($parsed === false) {
                return false;
            }
            
            $errors = DateTime::getLastErrors();
            
            // PHP 8.2+: если ошибок нет вообще, getLastErrors() возвращает false
            if ($errors === false) {
                return true;
            }
            
            // Если массив вернулся, проверяем счетчики ошибок
            return $errors['warning_count'] === 0 && $errors['error_count'] === 0;
        }

        $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';

        if ($amount === '') {
            die('Ошибка: Поле не должно быть пустым!');
        } elseif (!is_numeric($amount)) {
            die('Ошибка: Введите целое или дробное число!');
        } else {
            echo "Данные верны: " . $amount . '<br>';
        }

        if (checkDateString($_POST['date'], 'Y-m-d')) {
            echo "Данные верны: " . $_POST['date'] . '<br>';
        } else {
            die('Ошибка: Неправильный формат даты'); // Сработает правильно и без ошибок PHP
        }

        echo '<br>' . $_POST['date'], ' / ', $amount, ' / ', $_POST['description'], ' / ', 'Empty', ' / ', $_POST['type'];

        INSERT_TRANSACTION($_POST['date'], $amount, $_POST['description'], 'Empty', $_POST['type']);

        header('Location: ../../../app.php');
        exit;
    }
?>