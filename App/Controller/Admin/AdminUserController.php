<?php

namespace App\Controller\Admin;

use App\Model\BufeDao;
use App\Lib\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminUserController
{
    public function list()
    {
        $errorMessage =  "Helytelen felhasználónév vagy jelszó!";
        session_start();
        $users = BufeDao::userList();
        foreach ($users as $key => $user) {
            $orderCount = BufeDao::countOrdersByUser($user->id);
            $users[$key]->order_count = $orderCount;
        }

        if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
            $twig = (new AdminUserController())->setTwigEnvironment();
            echo $twig->render('bufe/admin/admin_components/admin_user.html.twig', ['userName' => $_SESSION['userName'], 'users' => $users]);
        } else {
            $twig = (new AdminUserController())->setTwigEnvironment();
            if (isset($_SESSION['loginFailed']) && $_SESSION['loginFailed']) {
                echo $twig->render('bufe/admin/admin_login.html.twig', ['message' => $errorMessage]);
                unset($_SESSION['loginFailed']);
            } else {
                echo $twig->render('bufe/admin/admin_login.html.twig');
            }
        }
    }

    public function delete()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $id = (int)$_POST['id'];
        //Adatok törlése
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
