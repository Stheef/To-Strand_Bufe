<?php namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminOrderController
{
    public function list()
    {
        $data = BufeDao::orderList();
        $twig = (new AdminOrderController())->setTwigEnvironment(); 
        echo $twig->render('bufe/admin/admin_components/admin_order.html.twig', ['orders'=>$data]);
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