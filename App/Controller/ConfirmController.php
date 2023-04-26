<?php

namespace App\Controller;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Lib\Request;
use PDO;

class ConfirmController
{
    public function confirm(Request $request)
    {
        //echo "Sikeres";

        $uri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', $uri);
        $code = isset($segments[2]) ? $segments[2] : null;


        if (!$code) {
            exit();
        }

        $dsn = 'mysql:host=localhost;dbname=to-strand_bufe';
        $username = 'root';
        $db_password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new PDO($dsn, $username, $db_password, $options);

            $stmt = $pdo->prepare('SELECT * FROM user_data WHERE confirm_code = :confirm_code');
            $stmt->execute(['confirm_code' => (string)$code]);
            $user = $stmt->fetch();

            if (!$user) {
                exit();
            }

            $stmt = $pdo->prepare('UPDATE user_data SET is_confirmed = 1 WHERE id = :id');
            $stmt->execute(['id' => (int)$user['id']]);

            header("Location: /reg-done");
            exit();
        } catch (PDOException $e) {
            echo "Sikertelen: " . $e->getMessage();
        }
    }
}
