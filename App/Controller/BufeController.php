<?php namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BufeController implements ICrudController
{
    public function list()
    {
        $data = BufeDao::all();
        $twig = (new BufeController())->setTwigEnvironment(); 
        echo $twig->render('bufe/home.html.twig', ['bufe'=>$data]);
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