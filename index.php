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
use App\Controller\CheckoutController;
use App\Controller\RegisterController;
use App\Controller\EmailController;
use App\Controller\Admin\AdminLoginController;
use App\Controller\Admin\AdminProductController;
use App\Controller\Admin\AdminUserAController;
use App\Controller\Admin\AdminUserController;
use App\Controller\Admin\AdminMessageController;
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


Router::get('/rolunk', function () {
    return ((new AboutController())->list());
});


Router::get('/kapcsolat', function () {
    return ((new ContactController())->list());
});


Router::get('/kosar', function () {
    return ((new CheckoutController())->list());
});


Router::get('/regisztracio', function () {
    return ((new RegisterController())->list());
});

Router::post('/regisztracio', function(){
    return ((new EmailController()));
});


//----------------ADMIN----------------//
Router::post('/login', function () {
    return ((new AdminLoginController())->login());
});


Router::get('/admin-bejelentkezes', function () {
    return ((new AdminLoginController())->adminLoginPage());
});


Router::get('/logout', function () {
    return ((new AdminLoginController())->logout());
});


Router::get('/admin-iranyitopult', function () {
    return ((new AdminLoginController())->adminDashboard());
});


Router::get('/admin-termekek', function () {
    return ((new AdminProductController())->list());
});

Router::get('/product-add', function () {
    (new AdminProductController())->add();
});


Router::post('/product-add', function () {
    (new AdminProductController())->save();
});


Router::get('/product-edit/([0-9]*)', function (Request $req, Response $res) {
    (new AdminProductController())->editById($req->params[0]);
});


Router::post('/product-edit', function () {
    (new AdminProductController())->update();
});


Router::get('/product-delete/([0-9]*)', function (Request $req, Response $res) {
    (new AdminProductController())->deleteById($req->params[0]);
});


Router::post('/product-delete', function () {
    (new AdminProductController())->delete();
});


Router::get('/admin-uzenetek', function () {
    return ((new AdminMessageController())->list());
});


Router::get('/admin-adminok', function () {
    return ((new AdminUserAController())->list());
});


Router::get('/admin-felhasznalok', function () {
    return ((new AdminUserController())->list());
});


Router::get('/admin-rendelesek', function () {
    return ((new AdminOrderController())->list());
});


Router::get('/admin-penzugyek', function () {
    return ((new AdminFinancialController())->list());
});


