<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Tag;

class SearchController extends Controller
{
    public function index(Request $request){
        $query = Plan::query();
        $tagQuery = Tag::query();

        //$request->input()で検索時に入力した項目を取得
        $search1 = $request->input('title');
        $search2 = $request->input('prefecture');
        // $search3 = $request->input('meeting_date_time');
        $search4 = $request->input('name');

        // タイトル入力フォームで入力した文字列を含むカラムを取得します
        if ($request->has('title') && $search1 != '') {
            $query->where('title', 'like', '%'.$search1.'%')->get();
        }

         // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択した都道府県と一致するカラムを取得
        if ($request->has('prefecture') && $search2 != ('指定なし')) {
            $query->where('prefecture', $search2)->get();
        }

         // タグ入力フォームで入力した文字列を含むカラムを取得します
        if ($request->has('name') && $search4 != '') {
            $tagQuery->where('name', 'like', '%'.$search4.'%')->get();
        }

        // //プランを1ページにつき3件ずつ表示
        $data1 = $query->paginate(3);
        $data2 = $tagQuery->paginate(3);

        

        return view('plans.search',[
            'data1' => $data1,
            'data2' => $data2,
            'search1' => $search1,
            'search2' => $search2,
        ]);
    }
}
