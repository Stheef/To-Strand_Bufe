<?php

namespace App\Controller;

use App\Model\BufeDao;
use App\Lib\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CheckoutController extends BaseController
{
    public function list()
    {

        $data = BufeDao::all();
        $townNames = BufeDao::getTownName();
        $paymentName = BufeDao::getPaymentMethod();
        $townData = [];
        foreach ($townNames as $town) {
            $townData[] = [
                'name' => $town->name,
                'deliveryFee' => $this->getDeliveryFee($town->name),
                'postalCode' => $this->getPostalCode($town->name),
            ];
        }
        $twig = (new CheckoutController())->setTwigEnvironment();
        echo $twig->render('bufe/ordering/checkout.html.twig', ['products' => $data, 'user_id' => $_SESSION['user_id'], 'session' => $this->getSessionData(), 'townData' => $townData, 'paymentName' => $paymentName]);
    }


    public  static function getDeliveryFee($townNames)
    {
        switch ($townNames) {
            case 'Rétság':
                return 1000;
            case 'Romhány':
                return 1000;
            case 'Felsőpetény':
                return 1500;
            case 'Nőtincs':
                return 1500;
            case 'Tereske':
                return 1500;
            case 'Szátok':
                return 1500;
            case 'Tolmács':
                return 1000;
            default:
                return 0;
        }
    }

    public function getPostalCode($townNames)
    {
        switch ($townNames) {
            case 'Bánk':
                return '2653';
            case 'Rétság':
                return '2651';
            case 'Felsőpetény':
                return '2611';
            case 'Romhány':
                return '2654';
            case 'Tolmács':
                return '2657';
            case 'Szátok':
                return '2656';
            case 'Tereske':
                return '2652';
            case 'Nőtincs':
                return '2610';
            default:
                return '';
        }
    }


    public static function save()
    {
        echo "<pre>";
        //print_r($_POST);
        echo "</pre>";

        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        //order tábla:
        $user_data_id = $_POST['user_id'];
        $payment_method_id = $_POST['payment_method_id'];
        $delivery_address = $_POST['address'];
        $town_name = $_POST['town_name'];
        $town_id = $_POST['town_id'];
        $amount = $_POST['amount'];
        $delivery_address_comment = $_POST['address_comment'];
        $comment = $_POST['comment'];
        $address = "$town_id $town_name, $delivery_address";
        if ($delivery_address_comment != "") {
            $address .= " (megj: $delivery_address_comment)";
        }

        //order_items tábla:
        $order_items = $_POST['order_items'];
        $sv = explode("|", $order_items);
        $db = count($sv) - 1;
        $items = [];
        for ($i = 0; $i < $db; $i++) {
            $s = explode("#", $sv[$i]);
            $sql = "SELECT name FROM `products` WHERE id = :id";
            $statement = $conn->prepare($sql);
            $statement->execute([
                'id' => $s[0]
            ]);
            $product = $statement->fetch();
            $product_name = $product['name'];
            $items[] = array("products_id" => $s[0], "name" => $product_name, "quantity" => $s[1], "unit_price" => $s[2]);
        }
        //print_r($items);

        $sql = "INSERT INTO `order` (user_data_id, payment_method_id, order_status_id, `address`, `time`, amount, comment)
                VALUES (:user_data_id, :payment_method_id, 1, :address, now(), :amount, :comment)";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'user_data_id' => $user_data_id,
            'payment_method_id' => $payment_method_id,
            'address' => $address,
            'amount' => $amount,
            'comment' => $comment
        ]);

        $sql = "SELECT MAX(id) AS max_id FROM `order` WHERE user_data_id = '$user_data_id'";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll();
        $order_id = $data[0]['max_id'];
        //print_r($data);

        $db = count($items);
        for ($i = 0; $i < $db; $i++) {
            $sql = "INSERT INTO order_items (order_id, products_id, quantity, unit_price)
            VALUES (:order_id, :products_id, :quantity, :unit_price)";
            $statement = $conn->prepare($sql);
            $statement->execute([
                'order_id' => $order_id,
                'products_id' => $items[$i]['products_id'],
                'quantity' => $items[$i]['quantity'],
                'unit_price' => $items[$i]['unit_price']
            ]);
        }

        $sql = "SELECT email FROM `user_data` WHERE id = :user_data_id";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'user_data_id' => $user_data_id
        ]);
        $user = $statement->fetch();
        $user_email = $user['email'];

        header('Location: /sikeres-rendeles');
        $deliveryFee = self::getDeliveryFee($town_name);
        self::sendOrderConfirmationEmail($user_email, $items, $deliveryFee, $address, $comment);
    }


    public function after_order()
    {
        $twig = (new CheckoutController())->setTwigEnvironment();
        echo $twig->render('bufe/ordering/after_order.html.twig', ['session' => $this->getSessionData()]);
    }


    private static function sendOrderConfirmationEmail($user_email, $items, $deliveryFee, $deliveryAddress, $orderComment)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'to.strand.bufe@gmail.com';
            $mail->Password = 'etrrvfcfkmjhtcff';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('to.strand.bufe@gmail.com', 'Tó-Strand Büfé');
            $mail->addAddress($user_email);

            $mail->isHTML(true);
            $mail->Subject = 'Köszönjük rendelését!';
            $deliveryInfo = "<p><strong>Szállítási cím:</strong> {$deliveryAddress}</p>";
            if (!empty($orderComment)) {
                $deliveryInfo .= "<p><strong>Megjegyzés:</strong> {$orderComment}</p>";
            }

            $itemList = '<table border="1" cellspacing="0" cellpadding="5">';
            $itemList .= '<tr><th>Termék neve</th><th>Mennyiség</th><th>Egységár</th><th>Teljes ár</th></tr>';

            $totalPrice = 0;
            foreach ($items as $item) {
                $itemTotalPrice = $item['quantity'] * $item['unit_price'];
                $totalPrice += $itemTotalPrice;
                $itemList .= "<tr>
                                <td>{$item['name']}</td>
                                <td>{$item['quantity']}</td>
                                <td>{$item['unit_price']} Ft</td>
                                <td>{$itemTotalPrice} Ft</td>
                            </tr>";
            }

            $itemList .= "<tr><td colspan='3' style='text-align:right;'><strong>Szállítási díj:</strong></td><td><strong>{$deliveryFee} Ft</strong></td></tr>";
            $totalPriceWithDelivery = $totalPrice + $deliveryFee;
            $itemList .= "<tr><td colspan='3' style='text-align:right;'><strong>Végösszeg:</strong></td><td><strong>{$totalPriceWithDelivery} Ft</strong></td></tr>";
            $itemList .= '</table>';

            $mail->Body = "Kedves vásárló,<br><br>Köszönjük szépen rendelését! Rendelésének részletei:<br><br>{$deliveryInfo}{$itemList}<br>Bármilyen kérdése merülne fel kérem keressen fel minket bizalommal.<br><br>Üdvözlettel,<br>a Tó-Strand Büfé csapata";
            $mail->send();
            echo 'Üzenet elküldve';
        } catch (Exception $e) {
            echo "Üzenet nem lett elküldve: {$mail->ErrorInfo}";
        }
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
