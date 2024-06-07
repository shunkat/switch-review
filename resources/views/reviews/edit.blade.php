<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
</head>
<body>
    <h1>Edit Review</h1>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $review->title) }}" required>
        </div>
        <div>
            <label for="review_comment">Comment:</label>
            <textarea id="review_comment" name="review_comment" required>{{ old('review_comment', $review->review_comment) }}</textarea>
        </div>
        <div>
            <label for="rate_star">Rating:</label>
            <select id="rate_star" name="rate_star" required>
                <option value="1" {{ old('rate_star', $review->rate_star) == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('rate_star', $review->rate_star) == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ old('rate_star', $review->rate_star) == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ old('rate_star', $review->rate_star) == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ old('rate_star', $review->rate_star) == 5 ? 'selected' : '' }}>5</option>
            </select>
        </div>
        <button type="submit">Update Review</button>
    </form>
</body>
</html>
