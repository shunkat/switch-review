<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\KeySwitch;
use Illuminate\Support\Facades\Auth;

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
        $review->user_id = Auth::id();
        $review->title = $validatedData['title'];
        $review->review_comment = $validatedData['review_comment'];
        $review->rate_star = $validatedData['rate_star'];
        $review->save();

        return redirect()->route('switches.detail', ['id' => $switchId])
        ->with('message', 'レビューを投稿しました');
    }


    // 修正
    public function edit($id)
{
    $review = Review::findOrFail($id);

    // ログインユーザーがレビューの所有者であるかを確認
    if (Auth::id() !== $review->user_id) {
        return redirect()->route('switches.detail', ['id' => $review->switch_id])
            ->with('error', '編集権限がありません');
    }

    return view('reviews.edit', compact('review'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'review_comment' => 'required',
        'rate_star' => 'required|integer|between:1,5',
    ]);

    $review = Review::findOrFail($id);

    // ログインユーザーがレビューの所有者であるかを確認
    if (Auth::id() !== $review->user_id) {
        return redirect()->route('switches.detail', ['id' => $review->switch_id])
            ->with('error', '編集権限がありません');
    }

    $review->title = $validatedData['title'];
    $review->review_comment = $validatedData['review_comment'];
    $review->rate_star = $validatedData['rate_star'];
    $review->save();

    return redirect()->route('switches.detail', ['id' => $review->switch_id])
        ->with('message', 'レビューを更新しました');
}
    // 削除
    public function destroy($id)
{
    $review = Review::findOrFail($id);

    // ログインユーザーがレビューの所有者であるかを確認
    if (Auth::id() !== $review->user_id) {
        return redirect()->route('switches.detail', ['id' => $review->switch_id])
            ->with('error', '削除権限がありません');
    }

    $review->delete();

    return redirect()->route('switches.detail', ['id' => $review->switch_id])
        ->with('message', 'レビューを削除しました');
}


}