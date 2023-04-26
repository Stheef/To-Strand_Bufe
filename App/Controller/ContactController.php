<?php

namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactController extends BaseController
{
    public function list()
    {
        $data = BufeDao::all();
        $twig = (new ContactController())->setTwigEnvironment();
        echo $twig->render('bufe/contact.html.twig', ['items' => $data, 'session' => $this->getSessionData()]);
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


    public function sendContactEmail($name, $email)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'to.strand.bufe@gmail.com';
            $mail->Password = 'etrrvfcfkmjhtcff';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('to.strand.bufe@gmail.com', 'Tó-Strand büfé');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = 'Üzenetvisszajelzés';
            $mail->Body = '<p>Kedves ' . $name . ',</p><p>Köszönjük, hogy felvette velünk a kapcsolatot! Munkatársaink hamarosan feldolgozzák üzenetét, és felvesszük önnel a kapcsolatot.</p><p>Üdvözlettel,</p><p>Tó-Strand büfé</p>';

            if ($mail->send()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error']);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function sendAdminNotificationEmail($name, $email, $phone, $topic, $message)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ugyfelszolgalat.tostrandbufe@gmail.com';
            $mail->Password = 'xchytuuckjqsmrnu';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            $mail->setFrom($email, $name);
            $mail->addAddress('to.strand.bufe@gmail.com', 'Tó-Strand büfé');
            $mail->isHTML(true);
            $mail->Subject = 'Új üzenet: ' . $topic;
    
            $mail->Body = '<p>Kedves Tó-Strand büfé,</p><p>Új üzenet érkezett:</p><p><strong>Név:</strong> ' . $name . '<br><strong>Email:</strong> ' . $email . '<br><strong>Telefonszám:</strong> ' . $phone . '<br><strong>Tárgy:</strong> ' . $topic . '<br><strong>Üzenet:</strong><br>' . nl2br($message) . '</p><p>Kérjük, válaszoljon az ügyfélnek mihamarabb.</p>';
    
            if ($mail->send()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error']);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
}
