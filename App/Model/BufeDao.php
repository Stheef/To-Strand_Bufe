<?php

namespace App\Model;

require_once 'NumberSeperator.php';

use App\Lib\Database;
use App\Lib\SessionHelper;

class BufeDao
{
    public static function homeList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products` 
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id` ORDER BY RAND() LIMIT 3;";
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


    public static function getCategories()
    {
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


    public static function getItemById($id)
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products`
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id`
                WHERE `products`.`id` = :id;";

        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();

        $result = $statement->fetch();

        error_log("Item ID: " . $id);
        error_log("Item data: " . var_export($result, true));

        return $result;
    }


    public static function getTownName()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `town_name`.`name`,`postal_code` FROM `town_name`;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $data = $statement->fetchAll();
        return $data;
    }


    public static function getPaymentMethod()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `payment_method`.`id`,`payment_method`.`name` FROM `payment_method`;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $data = $statement->fetchAll();
        return $data;
    }


    /****************** ADMIN ******************/
    public static function login()
    {
        $dbObj = new Database;
        $conn = $dbObj->getConnection();

        if (isset($_POST['login']) && !empty($_POST['userName']) && !empty($_POST['password'])) {
            $userName =  $_POST['userName'];
            $password =  $_POST['password'];

            // Update the SQL query
            $sql = "SELECT * FROM user_data WHERE user_name = :userName AND (permission = 0 OR permission = 2);";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':userName', $userName, \PDO::PARAM_STR);
            $statement->execute();
            $userData = $statement->fetch(\PDO::FETCH_ASSOC);

            if ($userData && password_verify($password, $userData['password'])) {
                $userId = $userData['id'];
                $userName = $userData['user_name'];

                session_start();

                $_SESSION['userId'] = $userId;
                $_SESSION['userName'] = $userName;
                return true;
            }
        }
        return false;
    }


    public static function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /admin-bejelentkezes");
        exit();
    }


    public static function productCategories()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `id`, `type`, `catname`
                FROM `product_category` ORDER BY `catname`;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function adminProductList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`, `product_category`.`type`
                FROM `products` 
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id` ORDER BY category_id;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function adminTopProductList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `products`.*, `product_category`.`catname`
                FROM `products` 
                LEFT JOIN `product_category` ON `products`.`category_id` = `product_category`.`id` ORDER BY RAND() LIMIT 5;";
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
                WHERE `permission` = 2";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function isUsernameTaken($userName, $excludeUserId = 0)
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT user_name FROM user_data WHERE (user_name = :user_name) AND id != :exclude_user_id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':user_name', $userName, \PDO::PARAM_STR);
        $statement->bindParam(':exclude_user_id', $excludeUserId, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        $statement->execute();

        return $statement->fetch();
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

    
    public static function orderList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT o.id, o.time, o.amount, o.comment, o.address, os.name as order_status, u.user_name, u.email, u.phone_number, p.name as 
        payment_method, GROUP_CONCAT(pr.name, ' (', oi.quantity, ')') as products 
        FROM `order` o 
        JOIN user_data u ON o.user_data_id = u.id 
        JOIN payment_method p ON o.payment_method_id = p.id 
        JOIN order_items oi ON o.id = oi.order_id 
        JOIN products pr ON oi.products_id = pr.id 
        JOIN order_status os ON o.order_status_id = os.id 
        GROUP BY o.time 
        ORDER BY o.id DESC;
        ";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function orderStatusCategories()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT `id`, `name`
                FROM `order_status`;";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function financialList()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT * FROM user_data";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function countUserData()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT COUNT(*) as user_count FROM user_data WHERE `permission` = 1";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetch();

        if (is_object($result)) {
            return $result->user_count;
        } else {
            return 0;
        }
    }


    public static function countProductData()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT COUNT(*) as product_count FROM products";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetch();

        if (is_object($result)) {
            return $result->product_count;
        } else {
            return 0;
        }
    }


    public static function countOrderData()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT COUNT(*) as order_count FROM `order`";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetch();

        if (is_object($result)) {
            return $result->order_count;
        } else {
            return 0;
        }
    }


    public static function countOrdersByUser($userId)
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT COUNT(*) as order_count FROM `order` WHERE user_data_id = :user_id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetch();

        if (is_object($result)) {
            return $result->order_count;
        } else {
            return 0;
        }
    }


    public static function sumDailyEarnings()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT SUM(amount) as daily_amount FROM `order` WHERE DATE(`time`) = CURDATE();";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetch();

        if (is_object($result)) {
            return number_format_custom($result->daily_amount);
        } else {
            return 0;
        }
    }


    public static function sumWeeklyEarnings()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT SUM(amount) as weekly_amount FROM `order` WHERE YEARWEEK(`time`, 1) = YEARWEEK(CURDATE(), 1);";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetch();

        if (is_object($result)) {
            return number_format_custom($result->weekly_amount);
        } else {
            return 0;
        }
    }


    public static function sumMonthlyEarnings()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT SUM(amount) as monthly_amount FROM `order` WHERE MONTH(`time`) = MONTH(CURDATE()) AND YEAR(`time`) = YEAR(CURDATE());";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetch();

        if (is_object($result)) {
            return number_format_custom($result->monthly_amount);
        } else {
            return 0;
        }
    }


    public static function sumYearlyEarnings()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT SUM(amount) as yearly_amount FROM `order` WHERE YEAR(`time`) = YEAR(CURDATE());";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetch();

        if (is_object($result)) {
            return number_format_custom($result->yearly_amount);
        } else {
            return 0;
        }
    }


    public static function getMostPurchasedProducts()
    {
        $databaseInstance = new Database();
        $connection = $databaseInstance->getConnection();

        $sql = "SELECT p.name, p.description, p.image, p.unit_price, c.catname AS category, SUM(oi.quantity) as total_quantity
        FROM order_items oi
        INNER JOIN products p ON oi.products_id = p.id
        INNER JOIN product_category c ON p.category_id = c.id
        GROUP BY oi.products_id
        ORDER BY total_quantity DESC
        LIMIT 5;";
        $preparedStatement = $connection->prepare($sql);
        $preparedStatement->setFetchMode(\PDO::FETCH_OBJ);
        $preparedStatement->execute();
        $results = $preparedStatement->fetchAll();

        if (is_array($results) && !empty($results)) {
            return $results;
        } else {
            return [];
        }
    }


    public static function yearlyEarningChart()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT MONTH(`time`) as month, SUM(amount) as total_amount FROM `order` WHERE YEAR(`time`) = YEAR(CURDATE()) GROUP BY MONTH(`time`);";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetchAll();

        if (is_array($result)) {
            return $result;
        } else {
            return [];
        }
    }


    public static function weeklyEarningChart()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT DATE(`time`) as date, SUM(amount) as total_amount FROM `order` WHERE YEARWEEK(`time`, 1) = YEARWEEK(CURDATE(), 1) GROUP BY DATE(`time`);";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetchAll();

        if (is_array($result)) {
            return $result;
        } else {
            return [];
        }
    }


    public static function categorySalesCount()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT pc.catname, COUNT(oi.id) AS total_orders
                FROM product_category pc
                JOIN products p ON pc.id = p.category_id
                JOIN order_items oi ON p.id = oi.products_id
                GROUP BY pc.catname
                ORDER BY pc.id";

        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetchAll();

        if (is_array($result)) {
            return $result;
        } else {
            return [];
        }
    }

    
    public static function weeklyEarningChartJune()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "SELECT WEEK(`time`, 3) as week, SUM(amount) as total_amount 
                FROM `order` 
                WHERE YEAR(`time`) = 2023 AND MONTH(`time`) = 6
                GROUP BY WEEK(`time`, 3);";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $result = $statement->fetchAll();

        if (is_array($result)) {
            return $result;
        } else {
            return [];
        }
    }
}
