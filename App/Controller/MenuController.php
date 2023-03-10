<?php namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class MenuController
{
    public function list()
    {
        $data = BufeDao::all();
        $categories = BufeDao::getCategories();
        $twig = (new MenuController())->setTwigEnvironment(); 
        echo $twig->render('bufe/menu.html.twig', ['items'=>$data, 'categories'=>$categories]);
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