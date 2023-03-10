<?php namespace App\Model;

    interface ICrudDao
    {
        public static function homeList();
        public static function all();
        public static function login();
        public static function logout();
        
    }
?>