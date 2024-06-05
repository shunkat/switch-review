<!DOCTYPE html>
<html>
<head>
    <title>レビュー投稿</title>
    <style>
        /* スタイルをここに記述 */
    </style>
</head>
<body>
    <h1>レビューを投稿する</h1>
    <ul>
        <li>
            <a href="{{ url('switches/'.$switch->switch_id) }}">
                {{ $switch->switch_name }}
            </a>
        </li>
    </ul>

    <form method="POST" action="{{ url('/reviews/store/'.$switch->switch_id) }}">
        @csrf

        <div>
            <label for="title">レビュータイトル</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div>
            <label for="review_comment">レビュー詳細</label>
            <textarea id="review_comment" name="review_comment" required></textarea>
        </div>

        <div>
            <label for="rate_star">レーティング</label>
            <select id="rate_star" name="rate_star" required>
                <option value="">選択してください</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} 星</option>
                @endfor
            </select>
        </div>

        <button type="submit">保存する</button>
    </form>
</body>
</html>