```php
@extends('layouts.app')

@section('content')

    <div class="card">

        <h1>Request #{{ $m->id }}</h1>

        <p>
            <b>Title:</b>
            {{ $m->title }}
        </p>

        <p>
            <b>Description:</b>
            {{ $m->description }}
        </p>

        <p>
            <b>Customer:</b>
            {{ $m->customer?->name ?? 'N/A' }}
        </p>

        <p>
            <b>Technician:</b>
            {{ $m->technician?->name ?? 'Not assigned' }}
        </p>

        <p>
            <b>Priority:</b>
            {{ ucfirst($m->priority) }}
        </p>

        <p>
            <b>Status:</b>
            {{ ucfirst(str_replace('_', ' ', $m->status)) }}
        </p>

        <p>
            <b>Requested At:</b>
            {{ $m->requested_at?->format('Y-m-d') }}
        </p>

    </div>


    <a href="{{ route('requests.edit', $m) }}">
        Edit Request
    </a>


    <form method="POST"
          action="{{ route('requests.destroy', $m) }}"
          style="margin-top: 15px;">

        @csrf
        @method('DELETE')

        <button type="submit">
            Delete
        </button>

    </form>


    @if($m->status === 'completed' && !$m->rating)

        <div class="card">

            <h2>Rate Request</h2>

            <form method="POST"
                  action="{{ route('ratings.store', $m) }}">

                @csrf

                <input
                    name="customer_id"
                    placeholder="Customer ID"
                >

                <input
                    name="rating"
                    type="number"
                    min="1"
                    max="5"
                    placeholder="Rating 1 - 5"
                >

                <textarea
                    name="comment"
                    placeholder="Comment"
                ></textarea>

                <br>

                <button type="submit">
                    Submit Rating
                </button>

            </form>

        </div>

    @endif

@endsection
```
