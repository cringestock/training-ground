<?php
    function pdo(): PDO {
        $db_config = [
            'host' => '127.0.0.1',
            'port' => '3306',
            'dbname' => 'finman',
            'user' => 'web_user',
            'pass' => '$F3wd_4wbus&)%EdeE^1&D',
        ];

        try {
            $pdo = new PDO("mysql:host=$db_config[host];port=$db_config[port];dbname=$db_config[dbname];charset=utf8", $db_config['user'], $db_config['pass']);
            $pdo->setAttribute(
                PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            die("Ошибка подключения: " . $e->getMessage());
        }

        return $pdo;
    }
?>