<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
   
    public function buildPie()
    {
        return $this->chart->pieChart()
            ->setTitle('Top 3 scorers of the team.')
            ->setSubtitle('Season 2021.')
            ->addData([40, 50, 30])
            ->setLabels(['Player 7', 'Player 10', 'Player 9']);
    }
       
    public function buildBar()
    {
        

            return $this->chart->barChart()
            ->setTitle('San Francisco vs Boston.')
            ->setSubtitle('Wins during season 2021.')
             ->addData('Boston', [7, 3, 8, 2, 6, 4])
            ->setXAxis(['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samdi']);

    }
    public function buildLine()
    {
        return $this->chart->lineChart()
        ->setTitle('Sales during 2021.')
        ->setSubtitle('Physical sales vs Digital sales.')
        ->addLine('Physical sales', [40, 93, 35, 42, 18, 82])
        ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

    }
    public function horizontalBar()
    {
        return $this->chart->horizontalBarChart()
        ->setTitle('Los Angeles vs Miami.')
        ->setSubtitle('Wins during season 2021.')
        ->setColors(['#FFC107'])
        ->addData('Boston', [7, 3, 8])
        ->setXAxis(['January', 'February', 'March']);

    }
}