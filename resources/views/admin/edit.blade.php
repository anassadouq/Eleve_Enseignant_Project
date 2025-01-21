@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="shadow p-4 mb-5 bg-white rounded" style="background-color: #f0f8ff; border: 1px solid #b0c4de;">
            <h2 class="text-center mb-4" style="color: #4682b4;">Update Admin</h2>
            <form action="{{ route('admin.update', $admin) }}" method="POST" class="p-4" style="border: 1px solid #b0c4de; border-radius: 10px;">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="nom" style="color: #4682b4; font-weight: bold;">Nom:</label>
                    <input type="text" name="name" value="{{ $admin->name }}" class="form-control" style="border: 1px solid #b0c4de;" required>
                </div>
                <div class="form-group mb-3">
                    <label for="adresse" style="color: #4682b4; font-weight: bold;">Email:</label>
                    <input type="email" name="email" value="{{ $admin->email }}" class="form-control" style="border: 1px solid #b0c4de;" required>
                </div>
                <div class="form-group mb-3">
                    <label for="role" style="color: #4682b4; font-weight: bold;">Role:</label>
                    <select name="role" class="form-control" style="border: 1px solid #b0c4de;">
                        <option value="student" {{ $admin->role == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="professeur" {{ $admin->role == 'professeur' ? 'selected' : '' }}>Professeur</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="classes" style="color: #4682b4; font-weight: bold;">Classes:</label>
                    <select name="classes[]" multiple class="form-control" style="border: 1px solid #b0c4de;">
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id }}" {{ in_array($classe->id, $admin->classes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $classe->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="background-color: #4682b4; border-color: #4682b4;">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
