<!-- resources/views/leads/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leads</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('leads.create') }}" class="btn btn-primary">Add New Lead</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead->name }}</td>
                    <td>{{ $lead->email }}</td>
                    <td>{{ $lead->phone }}</td>
                    <td>{{ $lead->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
