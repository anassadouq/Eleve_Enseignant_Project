@extends('layouts.app')

@section('content')
<div class="mx-2">
    <table class="text-center" id="myTable" width="90%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Matière</th>
                <th>Présence</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absences as $absence)
                @if($absence->presence == "Absent")
                    <tr>
                        <td>{{ $absence->date }}</td>
                        <td>{{ $absence->matiere }}</td>
                        <td>{{ $absence->presence }}</td>
                        <td>
                            @if ($absence->justif)
                                <a href="{{ asset($absence->justif) }}" target="_blank">Voir la justification</a>
                            @else
                            <p style="color:red;">Pas encore justifier</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('student.edit', $absence->id) }}" class="btn btn-primary">Justifier</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>    
</div>
@endsection