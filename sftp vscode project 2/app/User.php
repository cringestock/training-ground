<?php
    class User {
        public function getName() {
            $stmt = pdo()->prepare("SELECT name FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);

            $username = $stmt->fetch();

            if ($_SESSION['user_id'] === 3) {
                return $username['name'] . ' (админ)';
            } else {
                return $username['name'];
            }
        }

        public function logout() {
            session_unset();
            session_destroy();
            
            echo json_encode([
                'success' => true
            ]);

            exit;
        }
    }

    $user = new User();
?>