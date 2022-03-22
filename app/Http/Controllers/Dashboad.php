<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use App\Group;
use App\Project;
use App\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

use Illuminate\Http\Request;

class Dashboad extends Controller
{

    public function __construct(LarapexChart $chart)
    {
        $this->chart=$chart;
    }


    public function index(LarapexChart $chart){
       
        $users=User::all();
        $projects=Project::all();
        $departments=Department::all();
        $categorys=Category::all();
        $groups=Group::all();

       
    return view('rapport.home',compact('users','projects','departments','categorys','groups'));
   }

   public function summary()
   {
    $user=User::find(7);
    foreach($user->tasks()->get() as $task){
        
        $time_total=$task->sum('start_time');
        
          $chartBar=$this->chart->Barchart()
            ->setTitle('Dashboard')
            ->setSubtitle('Wins during season 2021.')
            ->addData($task->name, [$task->estimate_time, 29, 77, 28, 55, 45])
            ->setLabels(['task 1','task 2','task 3','task 4','task 5','task 6'])
            ->setXAxis(['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samdi']);
    
           $chartH_bar= $this->chart->horizontalBarChart()
            ->setTitle('Los Angeles vs Miami.')
            ->setSubtitle('Wins during season 2021.')
            ->addData($task->name, [$task->estimate_time, 29, 77, 28, 55, 45])
            ->setXAxis([$task->name]);

           $donutChart= $this->chart->pieChart()
            ->setTitle('Top 3 scorers of the team.')
            ->setSubtitle('Season 2021.')
            ->addData([23])
            ->setXAxis([$task->name]);
     
    }
       return view('rapport.summary',compact('chartBar','time_total','chartH_bar','donutChart'));
   }

   public function detailed()
   {
       $projects=Project::all();
       $user=User::find(5);
       $dpt=$user->departments()->get();
       $task=$user->tasks()->get();
       
       return view('rapport.detailed',compact('user','task','dpt','projects'));
   }

   public function weekly()
   {

    
    $user=User::find(5);
    $dpt=$user->departments()->get();
    $task=$user->tasks()->get();

       return view('rapport.weekly',compact('user','task','dpt'));
   }
}
