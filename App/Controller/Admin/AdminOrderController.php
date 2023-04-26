<?php

namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Lib\Database;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminOrderController
{
    public function list()
    {
        $errorMessage =  "Helytelen felhasználónév vagy jelszó!";
        session_start();
        $data = BufeDao::orderList();
        $statusCategories = BufeDao::orderStatusCategories();
        if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
            $twig = (new AdminOrderController())->setTwigEnvironment();
            echo $twig->render('bufe/admin/admin_components/admin_order.html.twig', ['userName' => $_SESSION['userName'], 'orders' => $data, 'statusCategories' => $statusCategories]);
        } else {
            $twig = (new AdminOrderController())->setTwigEnvironment();
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
        $status_id = (int)$_POST['status_id'];

        $sql = "UPDATE `order` SET `order_status_id` = :status_id WHERE `id` = :id";
        $statement = $conn->prepare($sql);
        $ok = $statement->execute([
            'status_id' => $status_id,
            'id' => $id,
        ]);

        header('Content-Type: application/json');
        if ($ok) {
            $response = new JsonResponse(["result" => "success"]);
        } else {
            $errorInfo = $statement->errorInfo();
            $response = new JsonResponse(["result" => "error", "details" => $errorInfo]);
        }

        return $response->send();
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
