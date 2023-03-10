<?php namespace App\Controller;
    use App\Model\BufeDao;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    use App\Lib\Database;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    if (isset($_POST["register"]))
    {
        $user_name = $_POST["user_name"];
        $phone_number = $_POST["phone_number"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
            //SMTP
            $mail->isSMTP();
            //SMTP szerver megadása
            $mail->Host = 'smtp.gmail.com';
            //SMTP engedélyezése
            $mail->SMTPAuth = true;
             //SMTP email
            $mail->Username = 'to.strand.bufe@gmail.com';
            //SMTP jelszó
            $mail->Password = 'tukhicodzrbpuywu';
             //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;
            //Recipients
            $mail->setFrom('to.strand.bufe@gmail.com', 'localhost:8000');
            //Add a recipient
            $mail->addAddress($email, $user_name);
            //Set email format to HTML
            $mail->isHTML(true);
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $mail->Subject = 'Hitelesítés';
            $mail->Body    = '<p>Az ön hitelesítő kódja: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
            $mail->send();
            // echo 'Message has been sent';
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            // Adatbázishoz csatlakozás
            $dbObj = new Database();
            $conn = $dbObj->getConnection();
            // beszúrás a felhasználók táblába
            $sql = "INSERT INTO user_data(user_name, phone_number, email, password, verification_code, email_verified_at) VALUES ('" . $user_name . "', '" . $phone_number . "', '" . $email . "', '" . $encrypted_password . "', '" . $verification_code . "', NULL)";
            mysqli_query($conn, $sql);
            header("Location: email-verification.php?email=" . $email);
            exit();
        } catch (Exception $e) {
            echo "Nem sikerült elküldeni az üzenetet. Hiba: {$mail->ErrorInfo}";
        }
    }


?>