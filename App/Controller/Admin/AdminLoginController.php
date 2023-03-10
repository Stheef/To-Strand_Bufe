<?php namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class AdminLoginController{
    public function login()
    {
        if (isset($_POST['login'])) {
            BufeDao::login();
        }
    }


    public function logout()
    {
        BufeDao::logout();
    }


    public function adminLoginPage() {
        $twig = (new AdminLoginController())->setTwigEnvironment(); 
        echo $twig->render('bufe/admin/admin_login.html.twig');
    }


    public function adminDashboard() {
        $errorMessage =  "<script type=\"text/javascript\"> Swal.fire({icon: 'error', title: 'Oops...', text: 'Something went wrong!'}) </script>";
        session_start();
        if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
            $twig = (new AdminLoginController())->setTwigEnvironment(); 
            echo $twig->render('bufe/admin/admin_components/admin_dashboard.html.twig', ['userName'=>$_SESSION['userName']]);
        } else {
            $twig = (new AdminLoginController())->setTwigEnvironment(); 
            echo $twig->render('bufe/admin/admin_login.html.twig', ['message'=>$errorMessage]);
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
?>