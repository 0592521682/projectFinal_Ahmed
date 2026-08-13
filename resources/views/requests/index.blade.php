
@extends('layouts.app')

@section('content')

    <div class="card">

        <h1>Maintenance Requests</h1>

        <form method="GET" class="row">

            <div>
                <label>Search</label>
                <input
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search title or customer"
                >
            </div>

            <div>
                <label>Status</label>
                <select name="status">
                    <option value="">All statuses</option>

                    @foreach(['pending', 'in_progress', 'completed', 'cancelled'] as $s)
                        <option value="{{ $s }}"
                            @selected(request('status') === $s)>
                            {{ ucfirst(str_replace('_', ' ', $s)) }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label>Priority</label>
                <select name="priority">
                    <option value="">All priorities</option>

                    @foreach(['low', 'medium', 'high'] as $p)
                        <option value="{{ $p }}"
                            @selected(request('priority') === $p)>
                            {{ ucfirst($p) }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label>Technician</label>
                <select name="technician_id">

                    <option value="">All technicians</option>

                    @foreach($technicians as $t)
                        <option value="{{ $t->id }}"
                            @selected(request('technician_id') == $t->id)>
                            {{ $t->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <button type="submit">
                    Filter
                </button>
            </div>

        </form>

    </div>


    <table>

        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Customer</th>
            <th>Technician</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @forelse($requests as $r)

            <tr>

                <td>{{ $r->id }}</td>

                <td>{{ $r->title }}</td>

                <td>{{ $r->customer?->name }}</td>

                <td>{{ $r->technician?->name ?? 'Not assigned' }}</td>

                <td>{{ ucfirst($r->priority) }}</td>

                <td>
                    {{ ucfirst(str_replace('_', ' ', $r->status)) }}
                </td>

                <td>
                    <a href="{{ route('requests.show', $r) }}">
                        View
                    </a>

                    |

                    <a href="{{ route('requests.edit', $r) }}">
                        Edit
                    </a>
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7">
                    No maintenance requests found.
                </td>
            </tr>

        @endforelse

    </table>

    <div class="card">
        {{ $requests->links() }}
    </div>

@endsection
```
