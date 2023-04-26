<?php

namespace App\Controller;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PDO;

class RegisterController extends BaseController
{
    public function displayRegistrationForm($error_message = null)
    {
        $data = BufeDao::all();
        $twig = (new AboutController())->setTwigEnvironment();
        echo $twig->render('bufe/user/register.html.twig', [
            'register' => $data,
            'error_message' => $error_message,
            'session' => $this->getSessionData()
        ]);
    }

    
    public function displayNewPassword($error_message = null)
    {
        $twig = (new RegisterController())->setTwigEnvironment();
        echo $twig->render('bufe/user/new-password.html.twig', ['error_message' => $error_message, 'session' => $this->getSessionData()]);
    }


    public function check()
    {
        $twig = (new RegisterController())->setTwigEnvironment();
        echo $twig->render('bufe/user/register-check.html.twig', ['session' => $this->getSessionData()]);
    }


    public function done()
    {
        $twig = (new RegisterController())->setTwigEnvironment();
        echo $twig->render('bufe/user/register-done.html.twig', ['session' => $this->getSessionData()]);
    }


    public function missing()
    {
        $twig = (new RegisterController())->setTwigEnvironment();
        echo $twig->render('bufe/user/register-missing.html.twig', ['session' => $this->getSessionData()]);
    }


    public function registerUser($user_name, $phone_number, $email, $password, $password2)
    {
        if (strlen($password) < 8 || strlen($password) > 20) {
            $error_message = "A jelszónak 8 és 20 karakter között kell lennie.";
            $this->displayRegistrationForm($error_message);
            exit();
        }
        $dsn = 'mysql:host=localhost;dbname=to-strand_bufe';
        $username = 'root';
        $db_password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new PDO($dsn, $username, $db_password, $options);
            $stmt = $pdo->prepare('SELECT user_name, email FROM user_data WHERE user_name = :user_name OR email = :email');
            $stmt->execute(['user_name' => $user_name, 'email' => $email]);
            if ($row = $stmt->fetch()) {
                if ($row['user_name'] == $user_name) {
                    $error_message = "Ez a felhasználónév már foglalt.";
                } elseif ($row['email'] == $email) {
                    $error_message = "Ez az email cím már használatban van.";
                }
                $this->displayRegistrationForm($error_message);
                exit();
            }

            $confirm_code = bin2hex(random_bytes(16));

            $stmt = $pdo->prepare('INSERT INTO user_data (user_name, phone_number, email, password, permission, is_confirmed, confirm_code) VALUES (:user_name, :phone_number, :email, :password, 1, :is_confirmed, :confirm_code)');
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([
                'user_name' => $user_name,
                'phone_number' => $phone_number,
                'email' => $email,
                'password' => $encrypted_password,
                'is_confirmed' => 0,
                'confirm_code' => $confirm_code
            ]);

            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 1;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'to.strand.bufe@gmail.com';
            $mail->Password = 'etrrvfcfkmjhtcff';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('to.strand.bufe@gmail.com', 'Tó-Strand büfé');
            $mail->addAddress($email, $user_name);
            $mail->isHTML(true);
            $mail->Subject = 'Regisztráció megerősítése';
            $mail->Body = '<p>Kérjük, kattintson az alábbi linkre a regisztráció megerősítéséhez: <a href="http://localhost:8000/confirm/' . $confirm_code . '">Regisztráció megerősítése</a></p>';
            $mail->send();

            header("Location: /reg-check");

            exit();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


    public function resetPassword($email)
{
    $dsn = 'mysql:host=localhost;dbname=to-strand_bufe';
    $username = 'root';
    $db_password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, $username, $db_password, $options);
        $stmt = $pdo->prepare('SELECT * FROM user_data WHERE email = :email');
        $stmt->execute(['email' => $email]);
        if ($row = $stmt->fetch()) {
            $temp_password = bin2hex(random_bytes(4));
            $encrypted_password = password_hash($temp_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE user_data SET password = :password WHERE email = :email');
            $stmt->execute(['email' => $email, 'password' => $encrypted_password]);
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 1;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'to.strand.bufe@gmail.com';
            $mail->Password = 'etrrvfcfkmjhtcff';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('to.strand.bufe@gmail.com', 'Tó-Strand büfé');
            $mail->addAddress($email, $row['user_name']);
            $mail->isHTML(true);
            $mail->Subject = 'Ideiglenes jelszó';
            $mail->Body = '<p>Ideiglenes új jelszava: ' . $temp_password . '</p><p>Kérjük, egyből jelentkezzen be és változtassa meg profiljában jelszavát.</p>';

            $mail->send();
            header("Location: /ujjelszo-siker");
            exit();
        } else {
            http_response_code(400);
            echo "Ilyen email cím nem található adatbázisunkban.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Kapcsolódási hiba: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Az üzenet nem lett elküldve. PHPMailer hiba: {$mail->ErrorInfo}";
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
