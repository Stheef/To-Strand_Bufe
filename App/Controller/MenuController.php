<?php

namespace App\Controller;

use App\Model\BufeDao;
use Twig\Loader\FilesystemLoader;

class MenuController extends BaseController
{
    public function list()
    {
        $data = BufeDao::all();
        $categories = BufeDao::getCategories();
        $twig = (new MenuController())->setTwigEnvironment();
        echo $twig->render('bufe/menu.html.twig', ['items' => $data, 'categories' => $categories, 'session' => $this->getSessionData()]);
    }

    public function item($request, $response, $id)
    {
        $item = BufeDao::getItemById($id);
        $data = BufeDao::homeList();

        $twig = $this->setTwigEnvironment();
        echo $twig->render('bufe/preview.html.twig', ['item' => $item, 'items' => $data, 'session' => $this->getSessionData()]);
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
