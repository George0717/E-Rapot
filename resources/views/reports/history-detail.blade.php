@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Detail History</h4>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>User:</strong> {{ $history->user->name }}</p>
            <p><strong>Action:</strong> {{ ucfirst($history->action) }}</p>
            <p><strong>Date:</strong> {{ $history->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    @if($history->action == 'updated')
    <div class="row">
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    Before
                </div>
                <div class="card-body">
                    <pre>{{ json_encode($history->before, JSON_PRETTY_PRINT) }}</pre>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    After
                </div>
                <div class="card-body">
                    <pre>{{ json_encode($history->after, JSON_PRETTY_PRINT) }}</pre>
                </div>
            </div>
        </div>
    </div>
    @endif

    <a href="{{ route('reports.history') }}" class="btn btn-secondary mt-3">
        Back
    </a>
</div>
@endsection
