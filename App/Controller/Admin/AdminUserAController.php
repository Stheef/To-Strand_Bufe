<?php

namespace App\Controller\Admin;

use App\Model\BufeDao;
use App\Lib\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminUserAController
{
    public function list()
    {
        $errorMessage =  "Helytelen felhasználónév vagy jelszó!";
        session_start();
        $data = BufeDao::adminList();
        if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
            $twig = (new AdminUserAController())->setTwigEnvironment();
            echo $twig->render('bufe/admin/admin_components/admin_user_admin.html.twig', ['userName' => $_SESSION['userName'], 'admins' => $data]);
        } else {
            $twig = (new AdminUserAController())->setTwigEnvironment();
            if (isset($_SESSION['loginFailed']) && $_SESSION['loginFailed']) {
                echo $twig->render('bufe/admin/admin_login.html.twig', ['message' => $errorMessage]);
                unset($_SESSION['loginFailed']);
            } else {
                echo $twig->render('bufe/admin/admin_login.html.twig');
            }
        }
    }


    public function save()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $id = (int)$_POST['id'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $takenData = BufeDao::isUsernameTaken($user_name, $id);
        if ($takenData) {
            $error_message = "";
            if ($takenData['user_name'] == $user_name) {
                $error_message = "Ez a felhasználónév már foglalt.";
            }
            header('Content-Type: application/json');
            echo json_encode(['error_message' => $error_message]);
            exit();
        }

        if ($id == 0) {
            $sql = "INSERT INTO user_data (`user_name`,`password`,`permission`)
                VALUES (:user_name,  :password, 2);";
            $statement = $conn->prepare($sql);
            $ok = $statement->execute([
                'user_name' => $user_name,
                'password' => $encrypted_password,
            ]);
        } else {
            $sql = "UPDATE user_data SET `user_name`='$user_name', `password`='$encrypted_password'";
            $sql .= "WHERE `id` = $id;";
            $statement = $conn->prepare($sql);
            $ok = $statement->execute();
            if ($ok) $ok = "siker";
            else $ok = "hiba";
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit();
    }


    public function delete()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $id = (int)$_POST['id'];
        $sql = "DELETE FROM user_data WHERE `id` = $id;";
        $statement = $conn->prepare($sql);
        $statement->execute();
    }


    public function setTwigEnvironment()
    {
        $loader = new FilesystemLoader(__DIR__ . '\..\..\View');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    }
}
