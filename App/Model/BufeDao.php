<?php namespace App\Model;

use App\Lib\Database;
use App\Model\ICrudDao;
  
class BufeDao Implements ICrudDao
{
    public static function homeList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products` 
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id` ORDER BY RAND() LIMIT 6;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function all()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products` 
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id` ORDER BY RAND();";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function adminProductList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products` 
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id` ORDER BY category_id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function adminList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `user_data`.*
                FROM `user_data`
                WHERE `permission` = 0";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function userList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `user_data`.*
                FROM `user_data`
                WHERE `permission` = 1";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function messageList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `user_data`.*
                FROM `user_data`
                WHERE `permission` = 1";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function orderList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products` 
                LEFT JOIN `product_category` ON `products`.`category_id` = `products`.`id` ORDER BY category_id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function financialList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products` 
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id` ORDER BY category_id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function login() {
        $dbObj = new Database;
        $conn = $dbObj->getConnection();

        if (isset($_POST['login']) && !empty($_POST['userName']) && !empty($_POST['password'])){
            $userName =  $_POST['userName'];
            $password =  sha1($_POST['password']);
    
            $sql = "SELECT * FROM user_data WHERE user_name LIKE '$userName' AND password LIKE '$password';";
            $statement = $conn->prepare($sql);
            $statement->execute();
            $userData = $statement->fetch(\PDO::FETCH_ASSOC);
            $userId = $userData['id'];
            $userName = $userData['user_name'];
    
            session_start();
            $_SESSION['userId'] = $userId;
            $_SESSION['userName'] = $userName;

            header("Location: /admin-iranyitopult"); 

        }
    }

    public static function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
    
        header("Location: /to-strand-bufe");
    }


    public static function productSave()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $termekKategoria = $_POST['termekKategoria'];
        $tipus = $_POST['tipus'];
        $nev = $_POST['nev'];
        $leiras = $_POST['leiras'];
        $kep = $_POST['kep'];
        $egysegar = $_POST['egysegar'];
        $sql = "INSERT INTO termekek (`kategoria_id`,`tipus`,`nev`,`leiras`,`kep`,`egysegar`)
                VALUES (:termekKategoria, :tipus, :nev, :leiras, :kep, :egysegar);";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'termekKategoria'=>$termekKategoria,
            'tipus'=>$tipus,
            'nev'=>$nev,
            'leiras'=>$leiras,
            'kep'=>$kep,
            'egysegar'=>$egysegar
        ]);      
    }


    public static function productGetById(int $id)
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $statement = $conn->prepare("SELECT * FROM termekek WHERE id =:id;");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute([
            'id'=>$id,
        ]);
        return $statement->fetch();
    }


    public static function productUpdate()
    { 
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $id = $_POST['id'];
        $termekKategoria = $_POST['termekKategoria'];
        $tipus = $_POST['tipus'];
        $nev = $_POST['nev'];
        $leiras = $_POST['leiras'];
        $kep = $_POST['kep'];
        $egysegar = $_POST['egysegar'];
        $sql = "UPDATE termekek SET `kategoria_id`=:termekKategoria, `tipus`=:tipus, `nev`=:nev, `leiras`=:leiras,`kep`=:kep,`egysegar`=:egysegar WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
            'termekKategoria'=>$termekKategoria,
            'tipus'=>$tipus,
            'nev'=>$nev,
            'leiras'=>$leiras,
            'kep'=>$kep,
            'egysegar'=>$egysegar,
            'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }

    
    public static function productDelete()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $id = $_POST['id'];
        $sql = "DELETE FROM termekek WHERE `id` =:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'id'=>$id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }
    public static function filterByCategory($categoryId)
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products`
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id`
                WHERE `product_category`.`id` = :categoryId
                ORDER BY RAND();";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute(['categoryId' => $categoryId]);
        return $statement->fetchAll();
    }

    public static function getCategories(){
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT *
                FROM `product_category` 
                ORDER BY catname;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $data = $statement->fetchAll();
        return $data;
    }
}