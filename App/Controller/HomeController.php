<?php

namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController extends BaseController
{
    public function list()
    {
        $data = BufeDao::homeList();
        $productCount = BufeDao::countProductData();
        $userCount = BufeDao::countUserData();
        $orderCount = BufeDao::countOrderData();
        $twig = (new HomeController())->setTwigEnvironment();
        echo $twig->render('bufe/home.html.twig', ['items' => $data, 'productCount' => $productCount, 'userCount' => $userCount, 'orderCount' => $orderCount, 'session' => $this->getSessionData()]);
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
