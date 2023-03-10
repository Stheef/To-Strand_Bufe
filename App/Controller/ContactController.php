<?php namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ContactController
{
    public function list()
    {
        $data = BufeDao::all();
        $twig = (new ContactController())->setTwigEnvironment(); 
        echo $twig->render('bufe/contact.html.twig', ['items'=>$data]);
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