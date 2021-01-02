<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index() 
    {
        $plans = Plan::all()->sortByDesc('created_at');
        return view('plans.index', ['plans' => $plans]);
    }

    public function create()
    {
        return view('plans.create');    
    }
}
