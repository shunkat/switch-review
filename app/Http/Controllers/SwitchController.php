<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeySwitch;
use App\Models\Review;

class SwitchController extends Controller
{
    public function index(Request $request)
    {
        // switchesテーブルからデータを取得
        $query = KeySwitch::with(['switchType', 'company']);

        
        // 検索機能
        if ($request->has('search') && $request->search != '') {
            $query->where('switch_name', 'like', '%' . $request->search . '%');
        }

        // 絞り込み機能
        if ($request->has('filter')) {
            if ($request->filter == 'type') {
                $query->orderBy('switch_type');
            } elseif ($request->filter == 'company') {
                $query->orderBy('company_id');
            }
        }
        $switches = $query->get();
        
        // ビューにデータを渡す
        return view('switches.index', compact('switches'));
    }

    public function detail($id)
    {
        // リクエストパラメータからIDを取得
        $id = request('id');

        // switchesテーブルからIDに一致するスイッチのデータを取得
        $switch = KeySwitch::with(['switchType', 'company'])->findOrFail($id);

        // reviewsテーブルからIDに一致するレビューのデータを取得
        $reviews = Review::where('switch_id', $id)->with('user')->get();

        // ビューにデータを渡す
        return view('switches.detail', compact('switch','reviews'));
    }
}
