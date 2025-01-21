@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="shadow p-4 mb-5 bg-white rounded" style="background-color: #f0f8ff; border: 1px solid #b0c4de;">
        <h2 class="text-center mb-4" style="color: #4682b4;">Update Class</h2>
        <form action="{{ route('classe.update', $classe) }}" method="POST" class="p-4" style="border: 1px solid #b0c4de; border-radius: 10px;">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name" style="color: #4682b4; font-weight: bold;">Nom:</label>
                <input type="text" name="name" id="name" value="{{ $classe->name }}" class="form-control" style="border: 1px solid #b0c4de;" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" style="background-color: #4682b4; border-color: #4682b4;">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
