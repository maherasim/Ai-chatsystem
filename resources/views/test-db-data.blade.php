<!DOCTYPE html>
<html>
<head>
    <title>Database Data Test</title>
</head>
<body>
    <h1>MongoDB Data Test</h1>

    <h2>Collections in DB ({{ DB::connection('mongodb')->getDatabaseName() }})</h2>
    <ul>
        @foreach($collections as $collection)
            <li>{{ $collection }}</li>
        @endforeach
    </ul>

    <h2>Sample Users</h2>
    <ul>
        @foreach($users as $user)
            <li>{{ json_encode($user) }}</li>
        @endforeach
    </ul>
</body>
</html>
