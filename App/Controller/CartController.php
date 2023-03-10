<?php namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CartController
{
    public function list()
    {
        $data = BufeDao::all();
        $twig = (new CartController())->setTwigEnvironment(); 
        echo $twig->render('bufe/menu_items/cart.html.twig', ['products'=>$data]);
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