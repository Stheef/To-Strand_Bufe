<?php namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminUserController
{
    public function list()
    {
        $data = BufeDao::userList();
        $twig = (new AdminUserController())->setTwigEnvironment(); 
        echo $twig->render('bufe/admin/admin_components/admin_users.html.twig', ['users'=>$data]);
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