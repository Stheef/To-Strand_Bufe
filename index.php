<?php
require __DIR__ . '/vendor/autoload.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controller\Home;
use App\Controller\HomeController;
use App\Controller\MenuController;
use App\Controller\AboutController;
use App\Controller\ContactController;
use App\Controller\CartController;
use App\Controller\CheckoutController;
use App\Controller\RegisterController;
use App\Controller\ConfirmController;
use App\Controller\LoginController;
use App\Controller\Admin\AdminDashboardController;
use App\Controller\Admin\AdminProductController;
use App\Controller\Admin\AdminUserAController;
use App\Controller\Admin\AdminUserController;
use App\Controller\Admin\AdminOrderController;
use App\Controller\Admin\AdminFinancialController;


Router::get('/', function () {
    return ((new HomeController())->list());
});


Router::get('/to-strand-bufe', function () {
    return ((new HomeController())->list());
});


Router::get('/etlap', function () {
    return ((new MenuController())->list());
});

Router::get('/etlap/([0-9]+)', function ($request, $response, $args) {
    $menuController = new MenuController();
    $menuController->item($request, $response, $args[0]);
});

Router::get('/bejelentkezes-nelkul', function () {
    return ((new CartController())->wo_login());
});

Router::get('/kosar', function () {
    $loginController = new LoginController();
    if ($loginController->isLoggedIn()) {
        return ((new CartController())->list());
    } else {
        header("Location: /bejelentkezes-nelkul");
        exit();
    }
});

Router::get('/penztar', function () {
    $loginController = new LoginController();
    if ($loginController->isLoggedIn()) {
        return ((new CheckoutController())->list());
    } else {
        header("Location: /bejelentkezes-nelkul");
        exit();
    }
});

Router::post('/checkout-save', function () {
    (new CheckoutController())->save();
});

Router::get('/sikeres-rendeles', function () {
    $loginController = new LoginController();
    if ($loginController->isLoggedIn()) {
        return ((new CheckoutController())->after_order());
    } else {
        header("Location: /bejelentkezes-nelkul");
        exit();
    }
});


Router::get('/rolunk', function () {
    return ((new AboutController())->list());
});


Router::get('/kapcsolat', function () {
    return ((new ContactController())->list());
});

Router::post('/kapcsolat', function () {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $topic = $_POST['topic'];
    $message = $_POST['message'];
    $contactController = new ContactController();
    $contactController->sendContactEmail($name, $email);
    $contactController->sendAdminNotificationEmail($name, $email, $phone, $topic, $message);
    header("Location: /kapcsolat");
    exit;
});



Router::get('/belepes', function () {
    return ((new LoginController())->display());
});
Router::post('/belepes', function () {
    return ((new LoginController())->login(new Request($_POST)));
});

Router::get('/kijelentkezes', function () {
    return ((new LoginController())->logout());
});

Router::get('/profil', function () {
    return ((new LoginController())->redirectToOwnProfile());
});

Router::get('/profil/([0-9]+)', function () {
    $uri = $_SERVER['REQUEST_URI'];
    $segments = explode('/', $uri);
    $userId = (isset($segments[2]) && is_numeric($segments[2])) ? (int) $segments[2] : 0;
    
    return ((new LoginController())->userProfile($userId));
});

Router::post('/profil/([0-9]+)', function ($request, $response, $args) {
    $userId = $args[0]; 
    return ((new LoginController())->updateProfile($userId, $_POST, $_FILES));
});

Router::get('/regisztracio', function () {
    return (new RegisterController())->displayRegistrationForm();
});

Router::post('/regisztracio', function () {
    $user_name = $_POST["user_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    return (new RegisterController())->registerUser($user_name, $phone_number, $email, $password, $password2);
});

Router::get('/reg-check', function () {
    return ((new RegisterController())->check());
});

Router::get('/confirm/([a-zA-Z0-9]+)', function ($code) {
    $request = new Request(['code' => $code]);

    return ((new ConfirmController())->confirm($request));
});

Router::get('/reg-missing', function () {
    return ((new RegisterController())->missing());
});

Router::get('/reg-done', function () {
    return ((new RegisterController())->done());
});

Router::get('/ujjelszo', function () {
    return ((new RegisterController())->displayNewPassword());
});

Router::post('/ujjelszo', function () {
    $email = $_POST['email'];
    return ((new RegisterController())->resetPassword($email));
});


//----------------ADMIN----------------//
Router::post('/login', function () {
    return ((new AdminDashboardController())->login());
});

Router::get('/admin-bejelentkezes', function () {
    return ((new AdminDashboardController())->adminLoginPage());
});

Router::get('/logout', function () {
    return ((new AdminDashboardController())->logout());
});

Router::get('/admin-iranyitopult', function () {
    return ((new AdminDashboardController())->list());
});


Router::get('/admin-termekek', function () {
    return (new AdminProductController())->list();
});

Router::post('/product-save', function () {
    (new AdminProductController())->save();
});

Router::post('/product-delete', function () {
    (new AdminProductController())->delete();
});


Router::get('/admin-adminok', function () {
    (new AdminUserAController())->list();
});

Router::post('/admin-save', function () {
    (new AdminUserAController())->save();
});

Router::post('/admin-delete', function () {
    (new AdminUserAController())->delete();
});


Router::get('/admin-felhasznalok', function () {
    return ((new AdminUserController())->list());
});

Router::post('/user-delete', function () {
    (new AdminUserController())->delete();
});


Router::get('/admin-rendelesek', function () {
    return ((new AdminOrderController())->list());
});

Router::post('/update-order-status', function () {
    (new AdminOrderController())->save();
});


Router::get('/admin-penzugyek', function () {
    return ((new AdminFinancialController())->list());
});


