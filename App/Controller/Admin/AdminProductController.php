<?php namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminProductController
{
    public function list()
    {
        $data = BufeDao::adminProductList();
        $twig = (new AdminProductController())->setTwigEnvironment(); 
        echo $twig->render('bufe/admin/admin_components/admin_product.html.twig', ['products'=>$data]);
    }

    public function add()
    {
        $twig = (new AdminProductController())->setTwigEnvironment();
        $vehicleCategories = BufeDao::all();
        echo $twig->render('bufe/admin/admin_components/admin.product.html.twig', ['productCategories'=>$productCategories]);
    }


    public function save()
    {
        if (isset($_POST['save']))
        {
            BufeDao::save();
            header('Location: /admin-termekek');
        }
    }


    public function update()
    {
        if (isset($_POST['update']))
        {
            BufeDao::update();
            header('Location: /admin-termekek');
        }
    }


    public function delete()
    {
        if (isset($_POST['delete']))
        {
            BufeDao::delete();
            header('Location: /admin-termekek');
        }    
    }


    public function editById(int $id)
    { 
        $twig = (new AdminProductController())->setTwigEnvironment();
        $productData = BufeDao::getById($id);
        if ($productData)
        {
            echo $twig->render('bufe/admin/admin_components/admin.product.html.twig', ['product'=>$productData,  'productCategories'=>$productCategories]);
        } else
        {
            echo $twig->render('404.html.twig');
        }
    }


    public function deleteById(int $id)
    {
        $twig = (new AdminProductController())->setTwigEnvironment();
        $productData = BufeDao::getById($id);
        if ($productData)
        {
            echo $twig->render('bufe/admin/admin_components/admin.product.html.twig', ['product'=>$productData]); 
        } else
        {
            echo $twig->render('404.html.twig');
        }
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