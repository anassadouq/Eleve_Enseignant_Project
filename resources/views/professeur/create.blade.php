@extends('layouts.app')
@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
</head>
<body>
    <center>
        <h1>Liste des Étudiants</h1>
    </center>

    <form action="{{ route('professeur.create') }}" method="GET" class="mx-3 mb-3">
        @csrf
        <!-- Sélectionner une classe -->
        <label for="classe_id">Sélectionner une classe:</label>
        <select name="classe_id" id="classe_id" class="form-control" required>
            <option value="">Toutes les classes</option>
            @foreach ($classes as $classe)
                <option value="{{ $classe->id }}" {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                 la classe:   {{ $classe->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary mt-2">Filtrer</button>
    </form>



    <form action="{{ route('professeur.store') }}" method="POST" class="mx-3">
        @csrf
        <label>Date: <input type="date" name="date" required></label>
        <label>matiere: <input type="text" name="matiere" required></label>

        <h2>Présences des Étudiants</h2>
        <ul>
            @foreach ($students as $student)
                <li>
                    <strong>{{ $student->name }}</strong>
                    <input type="radio" name="presence[{{ $student->id }}]" value="Présent" required> Présent
                    <input type="radio" name="presence[{{ $student->id }}]" value="Absent" required> Absent <br><br>
                </li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-primary">Confirmer</button>
    </form>
</body>
</html>
@endsection