<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <div>
        <h2>Dashboard</h2>
        <p>You are logged in!</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
