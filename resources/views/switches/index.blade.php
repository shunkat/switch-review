<!-- resources/views/switches/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Switches List</title>
</head>
<body>
    <h1>Switches List</h1>
    
    <!-- 検索フォーム -->
    <form method="GET" action="{{ url('switches') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for switches">
        <button type="submit">Search</button>

        <!-- 絞り込みボタン -->
        <select name="filter">
            <option value="">All</option>
            <option value="type">By Type</option>
            <option value="company">By Company</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    
    <ul>
        @foreach ($switches as $switch)
            <li>
                <a href="{{ url('switches', $switch->switch_id) }}">
                    {{ $switch->switch_name }} 
                    (Type: {{ $switch->switchType->switch_type_name }},
                    Company: {{ $switch->company->company_name }})
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
