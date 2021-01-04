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
        $plan->title = $request->title;
        $plan->body = $request->body;
        $plan->user_id = $request->user()->id;
        $plan->prefecture = $request->prefecture;
        $plan->cities = $request->cities;
        $plan->genre = $request->genre;
        $plan->meeting_date_time = $request->meeting_date_time;
        $plan->image = $request->image->nullable();
        $plan->age = $request->age;
        $plan->venue = $request->venue;
        $plan->membership_fee = $request->membership_fee;
        $plan->save();
        return redirect()->route('plans.index');
    }
}
