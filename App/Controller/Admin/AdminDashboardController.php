<?php

namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminDashboardController
{
    public function login()
    {
        if (isset($_POST['login'])) {
            $loginSuccess = BufeDao::login();
            if ($loginSuccess) {
                header("Location: /admin-iranyitopult");
                exit();
            } else {
                session_start();
                $_SESSION['loginFailed'] = true;
                header("Location: /admin-bejelentkezes");
                exit();
            }
        }
    }


    public function logout()
    {
        BufeDao::logout();
    }


    public function adminLoginPage()
    {
        $errorMessage =  "Helytelen felhasználónév vagy jelszó!";
        session_start();
        $twig = (new AdminDashboardController())->setTwigEnvironment();
        if (isset($_SESSION['loginFailed']) && $_SESSION['loginFailed']) {
            echo $twig->render('bufe/admin/admin_login.html.twig', ['message' => $errorMessage]);
            unset($_SESSION['loginFailed']);
        } else {
            echo $twig->render('bufe/admin/admin_login.html.twig');
        }
    }


    public function list()
    {
        $errorMessage =  "Helytelen felhasználónév vagy jelszó!";
        session_start();
        $mostPurchasedProducts = BufeDao::getMostPurchasedProducts();
        $userCount = BufeDao::countUserData();
        $orderCount = BufeDao::countOrderData();
        $dailyEarnings = BufeDao::sumDailyEarnings();
        $weeklyEarnings = BufeDao::sumWeeklyEarnings();
        $pieChartData = BufeDao::categorySalesCount();
        $categoryCount = array_map(function ($item) {
            return (int)$item->total_orders;
        }, $pieChartData);

        if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
            $twig = (new AdminDashboardController())->setTwigEnvironment();
            echo $twig->render('bufe/admin/admin_components/admin_dashboard.html.twig', [
                'userName' => $_SESSION['userName'],
                'products' => $mostPurchasedProducts,
                'userCount' => $userCount,
                'orderCount' => $orderCount,
                'dailyEarnings' => $dailyEarnings,
                'weeklyEarnings' => $weeklyEarnings,
                'categoryCount' => $categoryCount,
            ]);
        } else {
            $twig = (new AdminDashboardController())->setTwigEnvironment();
            if (isset($_SESSION['loginFailed']) && $_SESSION['loginFailed']) {
                echo $twig->render('bufe/admin/admin_login.html.twig', ['message' => $errorMessage]);
                unset($_SESSION['loginFailed']);
            } else {
                echo $twig->render('bufe/admin/admin_login.html.twig');
            }
        }
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
