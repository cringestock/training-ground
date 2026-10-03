<?php
    class Category {
        public function getAll() {
            $stmt = pdo()->prepare("SELECT * FROM categories WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            
            $categories = $stmt->fetchAll();

            return $categories;
        }

        public function create($data) {
            $input = [
                'user_id' => $_SESSION['user_id'],
                'name'    => $data['name'],
                'type'    => $data['type'],
            ];

            $errors_log = [];

            // Validate "amount"
            if (!isset($input['name'])) {
                $errors_log[] = "Поле name не может быть null";
            }
            
            if (empty($input['name'])) {
                $errors_log[] = "Поле name пусто!";
            }
            
            if ($input['name'] !== trim($input['amount'])) {
                $errors_log[] = "Поле name не должен содержать пробелы";
            }

            // Validate "type"
            if ($input['type'] !== 'income' && $input['type'] !== 'expense') {
                $errors_log[] = "Выберите один из указанных типов (доход или расход)";
            }

            if ($errors_log) {
                return $errors_log;
            }

            $stmt = pdo()->prepare("INSERT INTO categories (user_id, name, type) VALUES (:user_id, :name, :type)");
            $stmt->execute([
                ':user_id' => $input['user_id'],
                ':name'    => $input['name'],
                ':type'    => $input['type'],
            ]);

            return true;
        }

        public function getCategoriesCount() {
            $stmt = pdo()->prepare("SELECT * FROM categories WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $stmt = $stmt->fetchAll();
            
            return count($stmt);
        }
    }

    $category = new Category();
?>