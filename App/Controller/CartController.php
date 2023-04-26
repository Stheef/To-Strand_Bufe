<?php

namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CartController extends LoginController
{
    public function list()
    {
        $data = BufeDao::all();
        $twig = (new CartController())->setTwigEnvironment();
        echo $twig->render('bufe/ordering/cart.html.twig', ['products' => $data, 'session' => $this->getSessionData()]);
    }


    public function wo_login()
    {
        $data = BufeDao::all();
        $twig = (new CartController())->setTwigEnvironment();
        echo $twig->render('bufe/ordering/not_logged_in.html.twig', ['products' => $data, 'session' => $this->getSessionData()]);
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
