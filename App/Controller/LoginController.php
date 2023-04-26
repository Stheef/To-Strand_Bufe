<?php

namespace App\Controller;

use App\Lib\Request;
use Twig\Loader\FilesystemLoader;
use PDO;

class LoginController extends BaseController
{
    private function getUserById($userId)
    {
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
            $stmt = $pdo->prepare('SELECT * FROM user_data WHERE id = :id');
            $stmt->execute(['id' => $userId]);
            $user = $stmt->fetch();
            return $user;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return [];
        }
    }


    public function display($errorMessage = null)
    {
        $twig = (new LoginController())->setTwigEnvironment();
        echo $twig->render('bufe/user/login.html.twig', [
            'error_message' => $errorMessage,
            'session' => $this->getSessionData()
        ]);
    }



    public function userProfile($userId, $success = null)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->restrictToLoggedInUser();
        $this->restrictToOwnProfile($userId);
        $user = $this->getUserById($userId);

        $twig = $this->setTwigEnvironment();

        $dsn = 'mysql:host=localhost;dbname=to-strand_bufe';
        $username = 'root';
        $db_password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $pdo = new PDO($dsn, $username, $db_password, $options);

        $stmt = $pdo->prepare("SELECT o.*, os.name AS order_status, pm.name AS payment_method
                            FROM `order` AS o
                            JOIN order_status AS os ON o.order_status_id = os.id
                            JOIN payment_method AS pm ON o.payment_method_id = pm.id
                            WHERE o.user_data_id = :user_id");
        $stmt->bindParam('user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo $twig->render('bufe/user/user-profile.html.twig', [
            'user' => $user,
            'orders' => $orders,
            'session' => $_SESSION,
            'success' => $success
        ]);
    }


    public function redirectToOwnProfile()
    {
        $this->restrictToLoggedInUser();
        header('Location: /profil/' . $_SESSION['user_id']);
        exit();
    }

    public function login(Request $request)
    {
        $user_name = $request->getParam('user_name');
        $password = $request->getParam('password');

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

            $stmt = $pdo->prepare('SELECT * FROM user_data WHERE user_name = :user_name');
            $stmt->execute(['user_name' => $user_name]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                if ($user['is_confirmed'] == 1) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['user_name'];

                    header("Location: /profil/" . $user['id']);

                    exit();
                } else {
                    header("Location: /reg-missing");
                    exit();
                }
            } else {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $this->display("Hibás felhasználónév vagy jelszó.");
                exit();
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
        header("Location: /belepes");
        exit();
    }


    public function isLoggedIn()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']) && $_SESSION['user_id'] != '';
    }


    public function updateProfile($userId, $postData, $fileData)
    {
        $email = $postData['email'];
        $phone_number = $postData['phone_number'];
        $old_password = $postData['old_password'];
        $new_password = $postData['new_password'];
        $confirm_password = $postData['confirm_password'];

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
            if (!empty($old_password) && !empty($new_password) && !empty($confirm_password)) {
                if (strlen($new_password) < 8 || strlen($new_password) > 20) {
                    $this->userProfile($userId, false);
                    return;
                } else {
                    if ($new_password === $confirm_password) {
                        $stmt = $pdo->prepare('SELECT password FROM user_data WHERE id = :id');
                        $stmt->execute(['id' => $userId]);
                        $current_password = $stmt->fetchColumn();
                        if (password_verify($old_password, $current_password)) {
                            // Jelszó frissítése
                            $encrypted_password = password_hash($new_password, PASSWORD_DEFAULT);
                            $stmt = $pdo->prepare('UPDATE user_data SET password = :password WHERE id = :id');
                            $stmt->execute(['password' => $encrypted_password, 'id' => $userId]);
                        } else {
                            // Hibaüzenet
                            $this->userProfile($userId, false);
                            return;
                        }
                    } else {
                        // Hibaüzenet
                        $this->userProfile($userId, false);
                        return;
                    }
                }
            }
            $stmt = $pdo->prepare('UPDATE user_data SET email = :email, phone_number = :phone_number WHERE id = :id');
            $stmt->execute(['email' => $email, 'phone_number' => $phone_number, 'id' => $userId]);
            // Siker üzenet
            $this->userProfile($userId, true);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    public function setTwigEnvironment()
    {
        $loader = new FilesystemLoader(__DIR__ . '\..\View');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    }
}
