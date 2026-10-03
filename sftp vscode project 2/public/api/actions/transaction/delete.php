<?php
    session_start();

    if (empty($_SESSION['user_id'])) {
        header('Location: ../login.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../database.php';

        function DELETE_TRANSACTION() {
            $stmt = pdo()->prepare("DELETE FROM operations WHERE id = ? AND user_id = ?");
            $stmt->execute([$_POST['id'], $_SESSION['user_id']]);
            $stmt = $stmt->fetch();

            // echo json_encode($stmt);
        }
        
        // GET_CATEGORIES();
    }
?>