<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\KeySwitch;

class ReviewController extends Controller
{
    /**
     * レビュー作成画面を表示
     *
     * @param  int  $switchId
     * @return \Illuminate\Http\Response
     */
    public function create($switchId)
    {
        $switch = KeySwitch::findOrFail($switchId);
        return view('reviews.create', compact('switch'));
    }

    /**
     * 新しいレビューを保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $switchId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $switchId)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'review_comment' => 'required',
            'rate_star' => 'required|integer|between:1,5',
        ]);

        $review = new Review;
        $review->switch_id = $switchId;
        // $review->user_id = auth()->user()->id; // ログインユーザーのIDを設定
        $review->title = $validatedData['title'];
        $review->review_comment = $validatedData['review_comment'];
        $review->rate_star = $validatedData['rate_star'];
        $review->save();

        return redirect()->route('switches');
    }
}