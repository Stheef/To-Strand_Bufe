<?php

namespace App\Controller\Admin;

use App\Model\BufeDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AdminFinancialController
{
    public function list()
    {
        $errorMessage =  "Helytelen felhasználónév vagy jelszó!";
        session_start();
        $data = BufeDao::financialList();
        $dailyEarnings = BufeDao::sumDailyEarnings();
        $weeklyEarnings = BufeDao::sumWeeklyEarnings();
        $monthlyEarnings = BufeDao::sumMonthlyEarnings();
        $yearlyEarnings = BufeDao::sumYearlyEarnings();
        $yearlyEarningChart = BufeDao::yearlyEarningChart();
        $yearlyEarningChartData = array_fill(0, 12, 0);
        foreach ($yearlyEarningChart as $row) {
            $yearlyEarningChartData[$row->month - 1] = $row->total_amount;
        }

        $weeklyEarningChart = BufeDao::weeklyEarningChart();
        $weeklyEarningChartData = array_fill(0, 7, 0);
        $weeklyEarningChart = $weeklyEarningChart ?? [];
        foreach ($weeklyEarningChart as $row) {
            $dayOfWeek = date('N', strtotime($row->date)) - 1;
            $weeklyEarningChartData[$dayOfWeek] = $row->total_amount;
        }

        $weeklyEarningsJune = BufeDao::weeklyEarningChartJune();

        if (isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
            $twig = (new AdminFinancialController())->setTwigEnvironment();
            echo $twig->render('bufe/admin/admin_components/admin_financial.html.twig', [
                'userName' => $_SESSION['userName'],
                'financial' => $data,
                'dailyEarnings' => $dailyEarnings,
                'weeklyEarnings' => $weeklyEarnings,
                'monthlyEarnings' => $monthlyEarnings,
                'yearlyEarnings' => $yearlyEarnings,
                'yearlyEarningChartData' => $yearlyEarningChartData,
                'weeklyEarningChartData' => $weeklyEarningChartData,
                'weeklyEarningsJune' => $weeklyEarningsJune
            ]);
        } else {
            $twig = (new AdminFinancialController())->setTwigEnvironment();
            if (isset($_SESSION['loginFailed']) && $_SESSION['loginFailed']) {
                echo $twig->render('bufe/admin/admin_login.html.twig', ['message' => $errorMessage]);
                unset($_SESSION['loginFailed']);
            } else {
                echo $twig->render('bufe/admin/admin_login.html.twig');
            }
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
