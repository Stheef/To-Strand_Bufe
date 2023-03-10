<?php namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminFinancialController
{
    public function list()
    {
        $data = BufeDao::financialList();
        $twig = (new AdminFinancialController())->setTwigEnvironment(); 
        echo $twig->render('bufe/admin/admin_components/admin_financial.html.twig', ['financial'=>$data]);
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