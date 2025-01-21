@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4" style="color: #4682b4;">Justification de l'absence</h1>
    <div class="shadow p-4 mb-5 bg-white rounded" style="background-color: #e6f7ff; border: 1px solid #b0c4de;">
        <form action="{{ route('student.update', $absence->id) }}" method="POST" enctype="multipart/form-data" class="p-3">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="justif" class="form-label" style="color: #4682b4; font-weight: bold;">Justification (image)</label>
                <input type="file" name="justif" class="form-control" style="border: 1px solid #b0c4de;">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" style="background-color: #4682b4; border-color: #4682b4;">Justifier</button>
            </div>
        </form>
    </div>
</div>
@endsection