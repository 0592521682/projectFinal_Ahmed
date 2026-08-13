```php
@extends('layouts.app')

@section('content')

    <div class="card">
        <h1>Create Maintenance Request</h1>

        <form method="POST" action="{{ route('requests.store') }}">
            @csrf

            <div class="row">

                <div>
                    <label>Customer</label>
                    <select name="customer_id">
                        <option value="">Select Customer</option>

                        @foreach($customers as $c)
                            <option value="{{ $c->id }}">
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Technician</label>
                    <select name="technician_id">
                        <option value="">Not assigned</option>

                        @foreach($technicians as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Title</label>
                    <input
                        name="title"
                        placeholder="Enter request title"
                        value="{{ old('title') }}"
                    >
                </div>

                <div>
                    <label>Priority</label>
                    <select name="priority">
                        @foreach(['low', 'medium', 'high'] as $p)
                            <option value="{{ $p }}"
                                @selected(old('priority') === $p)>
                                {{ ucfirst($p) }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div>
                <label>Description</label>
                <textarea
                    name="description"
                    rows="5"
                    placeholder="Enter maintenance description"
                >{{ old('description') }}</textarea>
            </div>

            <div>
                <label>Requested At</label>
                <input
                    name="requested_at"
                    type="date"
                    value="{{ old('requested_at', now()->format('Y-m-d')) }}"
                >
            </div>

            <br>

            <button type="submit">
                Save Request
            </button>

        </form>
    </div>

@endsection
```
