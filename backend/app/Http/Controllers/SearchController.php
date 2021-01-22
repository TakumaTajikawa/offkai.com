<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Tag;

class SearchController extends Controller
{
    public function index(Request $request){
        $query = Plan::query();

        //$request->input()で検索時に入力した項目を取得
        $search1 = $request->input('title');
        $search2 = $request->input('prefecture');

        // タイトル入力フォームで入力した文字列を含むカラムを取得
        if ($request->has('title') && $search1 != '') {
            $query->where('title', 'like', '%'.$search1.'%')->get();
        }

         // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択した都道府県と一致するカラムを取得
        if ($request->has('prefecture') && $search2 != ('指定なし')) {
            $query->where('prefecture', $search2)->get();
        }

        // //プランを1ページにつき3件ずつ表示
        $data = $query->paginate(3);

        return view('plans.search',[
            'data' => $data,
            'search1' => $search1,
            'search2' => $search2,
        ]);
    }
}
