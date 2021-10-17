<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use App\Mail\ParticipationMail; 
use App\Models\Participation;
use App\Http\Requests\PlanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;



class PlanController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Plan::class, 'plan');
        $this->middleware(['auth', 'verified'])->only(['partcipation', 'unpartcipation']);
    }

    public function index() 
    {
        $plans = Plan::orderBy('created_at', 'desc')->paginate(3);
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
        $plan->fill($request->validated());
        $plan->user_id = $request->user()->id;

        if ($image = $request->file('img')) {
            $path = Storage::disk('s3')->putFile('planimage', $image, 'public');
            $plan->img = Storage::disk('s3')->url($path);
        }
        $plan->save();

        $request->tags->each(function ($tagName) use ($plan) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $plan->tags()->attach($tag);
        });

        session()->flash('msg_success', 'オフ会プランを投稿しました');
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
        if ($image = $request->file('img')) {
            $path = Storage::disk('s3')->putFile('planimage', $image, 'public');
            $plan->img = Storage::disk('s3')->url($path);
        }
        $plan->fill($request->validated())->save();
        $plan->tags()->detach();
        $request->tags->each(function ($tagName) use ($plan) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $plan->tags()->attach($tag);
        });

        session()->flash('msg_success', 'オフ会プランを編集しました');
        return redirect()->route('plans.index');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        session()->flash('msg_success', 'オフ会プランを削除しました');
        return redirect()->route('plans.index');
    }

    public function show(Plan $plan, Comment $comment)
    {
        $user = auth()->user();
        $comments = $plan->comments()->orderBy('created_at', 'desc')->get();
        $w = $plan->meeting_date_time->format("w");
        $week = ["日", "月", "火", "水", "木", "金", "土"];
        $today = date("Y-m-d H:i:s");
        $meeting_date_time = $plan->meeting_date_time->format("Y-m-d H:i:s");

        return view('plans.show', [
            'plan' => $plan,
            'comments' => $comments,
            'user' => $user,
            'week' => $week,
            'w' => $w,
            'today' => $today,
            'meeting_date_time' => $meeting_date_time,
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
    public function participation(int $id)
    {
        $authUser = Auth::user();

        $participation = Participation::where('plan_id', $id)->where('user_id', Auth::id())->first();
        if (Auth::check()) {
            if (isset($participation)) {
                return redirect()->back();
            } else {
                Participation::create([
                    'plan_id' => $id,
                    'user_id' => Auth::id(),
                ]);
                session()->flash('msg_success', 'このオフ会への参加申し込みが完了しました');
                Mail::send(new ParticipationMail($authUser));
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
            session()->flash('msg_success', 'このオフ会の参加をキャンセルしました');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
