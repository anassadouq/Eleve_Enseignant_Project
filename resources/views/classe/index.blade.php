@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="shadow p-4 mb-5 bg-white rounded" style="background-color: #f0f8ff; border: 1px solid #b0c4de;">
        <h2 class="text-center mb-4" style="color: #4682b4;">Classes</h2>
        <div class="mb-3 text-end">
            <a href="{{ route('classe.create') }}" class="btn btn-primary" style="background-color: #4682b4; border-color: #4682b4;">Create</a>
        </div>
        <table class="table table-bordered table-striped text-center" style="border: 1px solid #b0c4de;">
            <thead style="background-color: #4682b4; color: white;">
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $classe)
                    <tr style="background-color: #e6f2ff;">
                        <td>{{ $classe->name }}</td>
                        <td>
                            <form action="{{ route('classe.destroy', $classe) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('classe.edit', $classe) }}" class="btn btn-sm btn-info" style="color: white;">Update</a>
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
