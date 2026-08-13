
@extends('layouts.app')

@section('content')

    <h1>Dashboard</h1>

    <div class="row">

        @foreach([
            ['Total Requests', $total],
            ['Pending', $pending],
            ['In Progress', $inProgress],
            ['Completed', $completed]
        ] as [$name, $value])

            <div class="card">

                <h3>{{ $name }}</h3>

                <h2>{{ $value }}</h2>

            </div>

        @endforeach

    </div>

@endsection
```
