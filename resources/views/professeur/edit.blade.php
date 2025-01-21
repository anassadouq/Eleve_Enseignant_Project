@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <form  action="{{ route('professeur.update', $absence->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" value="{{ $absence->date }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="presence" class="form-label">Présence</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="presence" value="Présent" class="form-check-input" {{ $absence->presence == 'Présent' ? 'checked' : '' }}>
                    <label for="present" class="form-check-label">Présent</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="presence" value="Absent" class="form-check-input" {{ $absence->presence == 'Absent' ? 'checked' : '' }}>
                    <label for="absent" class="form-check-label">Absent</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection