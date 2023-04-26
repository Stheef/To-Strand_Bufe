<?php

namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AboutController extends BaseController
{
    public function list()
    {
        $data = BufeDao::all();
        $twig = (new AboutController())->setTwigEnvironment();
        echo $twig->render('bufe/about.html.twig', ['bufe' => $data, 'session' => $this->getSessionData()]);
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
