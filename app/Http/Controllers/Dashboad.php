<?php

namespace App\Http\Controllers;

use App\User;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Http\Request;

class Dashboad extends Controller
{
   public function index(LarapexChart $chart){
  
    return view('users.home',compact('chartBar','time_total','chartH_bar'));
   }
}
