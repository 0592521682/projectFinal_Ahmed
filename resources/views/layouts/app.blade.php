```php
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Maintenance Exam</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            color: #222;
        }

        nav {
            background: #1f2937;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #60a5fa;
        }

        nav span {
            color: #fff;
            margin-left: auto;
        }

        nav form {
            margin: 0;
        }

        nav button {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        nav button:hover {
            background: #b91c1c;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
        }

        th {
            background: #1f2937;
            color: white;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        tr:hover {
            background: #f3f4f6;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        button {
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
        }

        .success {
            max-width: 1100px;
            margin: 20px auto;
            padding: 12px 20px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
        }

        .error {
            color: #dc2626;
        }

        h1 {
            color: #1f2937;
        }
    </style>
</head>

<body>

    <nav>
        <a href="{{ route('dashboard') }}">Dashboard</a>

        <a href="{{ route('requests.index') }}">Requests</a>

        <a href="{{ route('requests.create') }}">New Request</a>

        @auth
            <span>{{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </nav>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <main>
        @yield('content')
    </main>

</body>

</html>
```
