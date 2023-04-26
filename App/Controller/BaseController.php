<?php

namespace App\Controller;

class BaseController
{
    protected function getSessionData()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION;
    }


    protected function restrictToLoggedInUser()
    {
        $sessionData = $this->getSessionData();
        if (!isset($sessionData['user_id'])) {
            header('Location: /belepes');
            exit();
        }
    }


    protected function restrictToOwnProfile($userId)
    {
        $sessionData = $this->getSessionData();
        if ($sessionData['user_id'] != $userId) {
            header('Location: /profil/' . $sessionData['user_id']);
            exit();
        }
    }
}
