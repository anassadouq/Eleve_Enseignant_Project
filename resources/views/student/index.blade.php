@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="table-responsive shadow p-3 mb-5 bg-light rounded" style="background-color: #e6f7ff;">
        <table class="table text-center" id="myTable" style="border: 1px solid #b0c4de;">
            <thead style="background-color: #4682b4; color: white;">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Matière</th>
                    <th scope="col">Présence</th>
                    <th scope="col">Justification</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absences as $absence)
                    @if($absence->presence == "Absent")
                        <tr class="align-middle" style="background-color: #f0f8ff; border-bottom: 1px solid #b0c4de;">
                            <td>{{ $absence->date }}</td>
                            <td>{{ $absence->matiere }}</td>
                            <td>
                                <span class="badge" style="background-color: #1e90ff; color: white;">{{ $absence->presence }}</span>
                            </td>
                            <td>
                                @if ($absence->justif)
                                    <a href="{{ asset($absence->justif) }}" target="_blank" style="color: #4682b4; font-weight: bold;">Voir la justification</a>
                                @else
                                    <p style="color: #d9534f; font-style: italic;">Pas encore justifiée</p>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('student.edit', $absence->id) }}" class="btn btn-sm" style="background-color: #5f9ea0; color: white;">Justifier</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection