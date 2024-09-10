@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Lead</h2>
    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Lead</button>
    </form>

    <hr>

    <h3>Import Leads</h3>
    <form action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">JSON File</label>
            <input type="file" id="file" name="file" class="form-control" accept=".json" required>
        </div>
        <button type="submit" class="btn btn-primary">Import Leads</button>
    </form>
</div>
@endsection
