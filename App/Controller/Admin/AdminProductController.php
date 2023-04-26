<?php

namespace App\Controller\Admin;

use App\Model\BufeDao;
use App\Lib\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminProductController
{
    public function list()
    {
        $errorMessage =  "Helytelen felhasználónév vagy jelszó!";
        session_start();
        $data = BufeDao::adminProductList();
        $productCategories = BufeDao::productCategories();
        if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
            $twig = (new AdminProductController())->setTwigEnvironment();
            echo $twig->render('bufe/admin/admin_components/admin_product.html.twig', ['userName' => $_SESSION['userName'], 'products' => $data, 'productCategories' => $productCategories]);
        } else {
            $twig = (new AdminProductController())->setTwigEnvironment();
            if (isset($_SESSION['loginFailed']) && $_SESSION['loginFailed']) {
                echo $twig->render('bufe/admin/admin_login.html.twig', ['message' => $errorMessage]);
                unset($_SESSION['loginFailed']);
            } else {
                echo $twig->render('bufe/admin/admin_login.html.twig');
            }
        }
    }


    public function save()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $id = (int)$_POST['id'];
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $unit_price = $_POST['unit_price'];
        if ($_FILES["kep"]["name"] != "" && $_FILES["kep"]["error"] == 0) {
            $sv = explode(".", $_FILES["kep"]["name"]);
            $ext = $sv[count($sv) - 1];
            $image = date("YmdHis") . "." . $ext;
            move_uploaded_file($_FILES["kep"]["tmp_name"], "App/assets/product_images/" . $image);
        } else {
            $image = "";
        }

        if ($id == 0) {
            $sql = "INSERT INTO products (`category_id`,`name`,`description`,`unit_price`,`image`)
                VALUES (:category_id, :name, :description, :unit_price, :image);";
            $statement = $conn->prepare($sql);
            $ok = $statement->execute([
                'category_id' => $category_id,
                'name' => $name,
                'description' => $description,
                'unit_price' => $unit_price,
                'image' => $image,
            ]);
        } else {
            //Korábbi kép fájl neve törléshez, ha új képet adott meg
            if ($image != "") {
                $sql = "SELECT image FROM products WHERE `id` = $id";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                $fnev = $result[0]["image"];
                if ($fnev != "" && file_exists("App/assets/product_images/" . $fnev)) {
                    unlink("App/assets/product_images/" . $fnev);
                }
            }
            //Adatok tárolása
            $sql = "UPDATE products SET `name`='$name', `category_id`='$category_id', `description`='$description', 
            `unit_price`='$unit_price'";
            if ($image != "") {
                $sql .= ",`image`='$image' ";
            }
            $sql .= "WHERE `id` = $id;";
            $statement = $conn->prepare($sql);
            $ok = $statement->execute();
            if ($ok) $ok = "siker";
            else $ok = "hiba";
        }
    }


    public function delete()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $id = (int)$_POST['id'];
        //Adatok törlése
        $sql = "DELETE FROM products WHERE `id` = $id;";
        $statement = $conn->prepare($sql);
        $statement->execute();
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
