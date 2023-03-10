<?php namespace App\Controller;

    interface ICrudController
    {
        public function list();
        public function login();
        public function logout();
        public function adminLoginPage();
        public function adminHome();
    }
?>