<?php namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminUserAController
{
    public function list()
    {
        $data = BufeDao::adminList();
        $twig = (new AdminUserAController())->setTwigEnvironment(); 
        echo $twig->render('bufe/admin/admin_components/admin_admin_user.html.twig', ['admins'=>$data]);
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