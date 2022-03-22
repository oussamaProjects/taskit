<?php

use App\Task;
namespace App\Charts;

use App\User;
use App\Task;
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
        $user=User::find(5);
       
        foreach( $user->tasks()->get() as $task){
            return $this->chart->pieChart()
            ->setTitle('Top 3 scorers of the team.')
            ->setSubtitle('Season 2021.')
            ->addData([$task->estimate_time])
            ->setXAxis([$task->name]);
        }
       
    }
       
    public function buildBar($id)
    {
        $tasks=Task::all();
        $user=User::find($id);

            return $this->chart->barChart()
            ->setTitle('Dashboard')
            ->setSubtitle('Wins during season 2021.')
            ->addData($user->name, [70, 29, 77, 28, 55, 45])
            ->setLabels(['task 1','task 2','task 3','task 4','task 5','task 6'])
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
        ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

    }
    public function donutChart(){

        $task=Task::find(5);

        return $this->chart->donutChart()
        ->addData([44])
        ->setLabels([$task->name]);
    }
}