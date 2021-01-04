<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use App\Http\Requests\PlanRequest;
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

    public function store(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->all());
        $plan->user_id = $request->user()->id;
        $plan->save();
        return redirect()->route('plans.index');
    }
}
