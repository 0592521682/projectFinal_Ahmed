```php
@extends('layouts.app')

@section('content')

    <div class="card">

        <h1>Edit Request #{{ $maintenanceRequest->id }}</h1>

        <form method="POST"
              action="{{ route('requests.update', $maintenanceRequest) }}">

            @csrf
            @method('PUT')

            <div class="row">

                <div>
                    <label>Title</label>
                    <input
                        name="title"
                        value="{{ old('title', $maintenanceRequest->title) }}"
                    >
                </div>

                <div>
                    <label>Customer</label>
                    <select name="customer_id">

                        @foreach($customers as $c)
                            <option value="{{ $c->id }}"
                                @selected($c->id == $maintenanceRequest->customer_id)>
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
                            <option value="{{ $t->id }}"
                                @selected($t->id == $maintenanceRequest->technician_id)>
                                {{ $t->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label>Priority</label>
                    <select name="priority">

                        @foreach(['low', 'medium', 'high'] as $p)
                            <option value="{{ $p }}"
                                @selected($p === $maintenanceRequest->priority)>
                                {{ ucfirst($p) }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label>Status</label>
                    <select name="status">

                        @foreach(['pending', 'in_progress', 'completed', 'cancelled'] as $s)
                            <option value="{{ $s }}"
                                @selected($s === $maintenanceRequest->status)>
                                {{ ucfirst(str_replace('_', ' ', $s)) }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label>Requested At</label>
                    <input
                        name="requested_at"
                        type="date"
                        value="{{ $maintenanceRequest->requested_at?->format('Y-m-d') }}"
                    >
                </div>

            </div>

            <div>
                <label>Description</label>
                <textarea
                    name="description"
                    rows="5"
                >{{ old('description', $maintenanceRequest->description) }}</textarea>
            </div>

            <br>

            <button type="submit">
                Update Request
            </button>

        </form>

    </div>

@endsection
```
