<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use App\Http\Requests\PlanRequest;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Plan::class, 'plan');
    }

    public function index() 
    {
        $plans = Plan::all()->sortByDesc('created_at');
        return view('plans.index', ['plans' => $plans]);
    }

    public function create(Plan $plan)
    {
        return view('plans.create', ['plan' => $plan]);    
    }

    public function store(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->all());
        $plan->user_id = $request->user()->id;
        $plan->save();
        return redirect()->route('plans.index');
    }

    public function edit(Plan $plan)
    {
        return view('plans.edit', ['plan' => $plan]);
    }

    public function update(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->all())->save();
        return redirect()->route('plans.index');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index');
    }

    public function show(Plan $plan)
    {
        return view('plans.show', ['plan' => $plan]);
    }  
}
