<?php namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CheckoutController
{
    public function list()
    {
        $data = BufeDao::all();
        $twig = (new CheckoutController())->setTwigEnvironment(); 
        echo $twig->render('bufe/menu_items/checkout.html.twig', ['products'=>$data]);
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