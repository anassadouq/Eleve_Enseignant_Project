@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h1>Justification de l'absence</h1>
        
        <form action="{{ route('student.update', $absence->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="justif" class="form-label">Justification (image)</label>
                <input type="file" name="justif" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Justifier</button>
        </form>
    </div>
@endsection