@extends('layouts.app')

@section('content')
    <html>
        <head>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css"/>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        </head>
        <body>
            <div class="container my-5">
                <div class="shadow p-4 mb-5 bg-white rounded" style="background-color: #f0f8ff; border: 1px solid #b0c4de;">
                    <h2 class="text-center mb-4" style="color: #4682b4;">Gestion des Présences</h2>
                    <a href="{{ route('professeur.create') }}" class="btn btn-primary mb-3" style="background-color: #4682b4; border-color: #4682b4;">La présence</a>

                    <form action="{{ route('professeur.index') }}" method="GET" class="mb-3">
                        <label for="id_classe" style="color: #4682b4; font-weight: bold;">Sélectionner une classe:</label>
                        <select name="id_classe" id="id_classe" class="form-control" style="border: 1px solid #b0c4de;">
                            <option value="">Toutes les classes</option>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}" {{ request('id_classe') == $classe->id ? 'selected' : '' }}>
                                    Classe : {{ $classe->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-2" style="background-color: #4682b4; border-color: #4682b4;">Filtrer</button>
                    </form>

                    <table class="table table-striped" id="myTable" style="width: 100%; border: 1px solid #b0c4de;">
                        <thead style="background-color: #4682b4; color: white;">
                            <tr>
                                <th>Date</th>
                                <th>Matière</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Présence</th>
                                <th>Justif</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absences as $absence)
                                <tr style="background-color: #e6f2ff;">
                                    <td>{{ $absence->date }}</td>
                                    <td>{{ $absence->matiere }}</td>
                                    <td>{{ $absence->user->name }}</td>
                                    <td><a href="mailto:{{ $absence->user->email }}" style="color: #4682b4;">{{ $absence->user->email }}</a></td>
                                    <td style="color: {{ $absence->presence == 'Absent' ? 'red' : 'black' }};">
                                        {{ $absence->presence }}
                                    </td>
                                    <td>
                                        @if ($absence->justif)
                                            <a href="{{ asset($absence->justif) }}" target="_blank" style="color: #4682b4;">Voir la justification</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('professeur.edit', $absence->id) }}" class="btn btn-secondary btn-sm">Modifier</a>
                                        <form action="{{ route('professeur.destroy', $absence->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ça ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable({
                        dom: 'Blfrtip',
                        lengthChange: false,
                        paging: false,
                        buttons: [{
                            extend: 'collection',
                            text: 'Export',
                            buttons: [
                                {
                                    extend: 'excelHtml5',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4]
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4]
                                    }
                                }
                            ],
                        }]
                    });
                });
            </script>
        </body>
    </html>
@endsection