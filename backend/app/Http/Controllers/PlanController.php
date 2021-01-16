<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use App\Models\Participation;
use App\Http\Requests\PlanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Plan::class, 'plan');
        $this->middleware(['auth', 'verified'])->only(['partcipation', 'unpartcipation']);
    }

    public function index() 
    {
        $plans = Plan::all()->sortByDesc('created_at');
        return view('plans.index', [
            'plans' => $plans,
        ]);
    }

    public function create(Plan $plan)
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('plans.create', [
            'plan' => $plan,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function store(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->all());
        $plan->user_id = $request->user()->id;
        $plan->save();

        $request->tags->each(function ($tagName) use ($plan) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $plan->tags()->attach($tag);
        });

        return redirect()->route('plans.index');
    }

    public function edit(Plan $plan)
    {
        $tagNames = $plan->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('plans.edit', [
            'plan' => $plan,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function update(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->all())->save();
        $plan->tags()->detach();
        $request->tags->each(function ($tagName) use ($plan) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $plan->tags()->attach($tag);
        });
        return redirect()->route('plans.index');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index');
    }

    public function show(Plan $plan, Comment $comment)
    {
        $user = auth()->user();
        $comments = $plan->comments()->orderBy('created_at', 'desc')->get();
        $w = $plan->meeting_date_time->format("w");
        $week = ["日", "月", "火", "水", "木", "金", "土"];

        return view('plans.show', [
            'plan' => $plan,
            'comments' => $comments,
            'user' => $user,
            'week' => $week,
            'w' => $w,
        ]);
    }

    public function interest(Request $request, Plan $plan)
    {
        $plan->interests()->detach($request->user()->id);
        $plan->interests()->attach($request->user()->id);

        return [
            'id' => $plan->id,
            'countInterests' => $plan->count_interests,
        ];
    }

    public function uninterest(Request $request, Plan $plan)
    {
        $plan->interests()->detach($request->user()->id);

        return [
            'id' => $plan->id,
            'countInterests' => $plan->count_interests,
        ];
    }

    /**
  * 引数のIDに紐づくリプライにPARTICIPATIONする
  *
  * @param $id リプライID
  * @return \Illuminate\Http\RedirectResponse
  */
    public function participation($id)
    {

        $participation = Participation::where('plan_id', $id)->where('user_id', Auth::id())->first();
        if (Auth::check()) {
            if (isset($participation)) {
                return redirect()->back();
            } else {
                Participation::create([
                    'plan_id' => $id,
                    'user_id' => Auth::id(),
                ]);
                session()->flash('success', 'You Liked the Reply.');
                return redirect()->back();
            }
        } else {
            return redirect('login')->with('status', 'ログインしてください！');
        }
    }

    /**
     * 引数のIDに紐づくリプライにUNPARTICIPATIONする
     *
     * @param $id リプライID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unparticipation($id)
    {
        $participation = Participation::where('plan_id', $id)->where('user_id', Auth::id())->first();
        if (isset($participation)) {
            $participation->delete();
            session()->flash('success', 'You Unliked the Reply.');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
