<?php
    class Operation {
        public function getAll() {
            $stmt = pdo()->prepare("
                SELECT
                    operations.id, 
                    operations.amount, 
                    operations.description, 
                    operations.type, 
                    operations.category_id, 
                    categories.name AS category_name, 
                    operations.date 
                FROM operations 
                JOIN categories 
                    ON operations.category_id = categories.id 
                WHERE operations.user_id = ?
                ORDER BY operations.id ASC
            ");
            $stmt->execute([$_SESSION['user_id']]);

            $transactions = $stmt->fetchAll();

            return $transactions;
        }

        public function getById($id) {
            $stmt = pdo()->prepare("SELECT * FROM operations WHERE user_id = ? AND id = ?");
            $stmt->execute([$_SESSION['user_id'], $id]);

            $transaction = $stmt->fetch();

            return $transaction;
        }

        public function getByCategory($category_id) {
            $stmt = pdo()->prepare("
                SELECT
                    operations.id, 
                    operations.amount, 
                    operations.description, 
                    operations.type, 
                    operations.category_id, 
                    categories.name AS category_name, 
                    operations.date 
                FROM operations 
                JOIN categories 
                    ON operations.category_id = categories.id
                WHERE operations.user_id = ? AND operations.category_id = ?
            ");

            $stmt->execute([$_SESSION['user_id'], $category_id]);

            $transactions = $stmt->fetchAll();

            return $transactions;
        }

        public function create($data) {
            $input = [
                'user_id'     => $_SESSION['user_id'],
                'category_id' => $data['category_id'],
                'amount'      => $data['amount'],
                'description' => $data['description'],
                'type'        => $data['type'],
                'date'        => $data['date'],
            ];

            $errors_log = [];

            // Validate "amount"
            if (!isset($input['amount'])) {
                $errors_log[] = "Поле amount не может быть null";
            }
            
            if (empty($input['amount'])) {
                $errors_log[] = "Поле amount пусто!";
            }
            
            if ($input['amount'] !== trim($input['amount'])) {
                $errors_log[] = "Поле amount не должен содержать пробелы";
            }
            
            if (!is_numeric($input['amount'])) {
                $errors_log[] = "Поле amount не является числом";
            }

            // Validate "date"
            if (!isset($input['date'])) {
                $errors_log[] = "Поле date не может быть null";
            }

            if (empty($input['date'])) {
                $errors_log[] = "Поле date пусто!";
            }

            if ($input['date'] === "") {
                $errors_log[] = "Поле date пусто!";
            }

            $dateObject = DateTime::createFromFormat('Y-m-d', $input['date']);

            if (!$dateObject || $dateObject->format('Y-m-d') !== $input['date']) {
                $errors_log[] = "Некорректная дата";
            }

            // Validate "type"
            if ($input['type'] !== 'income' && $input['type'] !== 'expense') {
                $errors_log[] = "Выберите один из указанных типов (доход или расход)";
            }

            if ($errors_log) {
                return $errors_log;
            }

            $stmt = pdo()->prepare("INSERT INTO operations (user_id, category_id, amount, description, type, date) VALUES (:user_id, :category_id, :amount, :description, :type, :date)");
            $stmt->execute([
                ':user_id'     => $input['user_id'],
                ':category_id' => $input['category_id'],
                ':amount'      => $input['amount'],
                ':description' => $input['description'],
                ':type'        => $input['type'],
                ':date'        => $input['date'],
            ]);

            return true;
        }

        public function delete($id) {
            $stmt = pdo()->prepare("DELETE FROM operations WHERE user_id = ? AND id = ?");
            $stmt->execute([$_SESSION['user_id'], $id]);

            $transaction = $stmt->fetch();

            return $transaction;
        }

        public function totalAmount($type) {
            $stmt = pdo()->prepare("SELECT amount FROM operations WHERE type = ? AND user_id = ?");
            $stmt->execute([$type, $_SESSION['user_id']]);
            $amount = $stmt->fetchAll();

            $sum = 0;

            foreach($amount as $operation) {
                $sum += $operation['amount'];
            }

            return $sum;
        }

        public function test_TotalAmount($type, $category_id) {
            $stmt = pdo()->prepare("SELECT amount FROM operations WHERE type = ? AND category_id = ? AND user_id = ?");
            $stmt->execute([$type, $category_id, $_SESSION['user_id']]);
            $amount = $stmt->fetchAll();

            $sum = 0;

            foreach($amount as $operation) {
                $sum += $operation['amount'];
            }

            return $sum;
        }

        public function getOperationsCount() {
            $stmt = pdo()->prepare("SELECT * FROM operations WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $stmt = $stmt->fetchAll();
            
            return count($stmt);
        }
    }

    $operation = new Operation();
?>