<!DOCTYPE html>
<html>
<head>
    <title>Switch Details</title>
</head>
<body>
    <h1>{{ $switch->switch_name }} Details</h1>
    <p>Type: {{ $switch->switchType->switch_type_name ?? 'Unknown' }}</p>
    <p>Company: {{ $switch->company->company_name ?? 'Unknown' }}</p>
    <p>Activation Pressure: {{ $switch->activation_pressure }}</p>
    <p>Bottom Out Force: {{ $switch->bottom_out_force }}</p>

    <h2>Reviews
        <a href="{{ url('reviews/create', $switch->switch_id) }}">レビュー追加</a>
    </h2>
    <ul>
        @forelse ($reviews as $review)
            <li>
                <strong>{{ $review->title }}</strong> by {{ $review->user->name ?? 'Unknown' }} <br>
                {{ $review->review_comment }} <br>
                Rating: {{ $review->rate_star }} stars
                @if (Auth::check() && Auth::user()->id == $review->user_id)
                    <br>
                    <a href="{{ url('reviews/edit', $review->id) }}">修正</a>
                    <form action="{{ url('reviews', $review->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                @endif
            </li>
        @empty
            <li>No reviews yet.</li>
        @endforelse
    </ul>
</body>
</html>
