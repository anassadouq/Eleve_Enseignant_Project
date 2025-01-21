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
            <div class="mx-2">
                <a href="{{ route('professeur.create') }}" class="btn btn-primary mb-3">La présence</a>

                <!-- Formulaire de sélection de classe -->
                <form action="{{ route('professeur.index') }}" method="GET" class="mb-3">
                    <label for="id_classe">Sélectionner une classe:</label>
                    <select name="id_classe" id="id_classe" class="form-control">
                        <option value="">Toutes les classes</option>
                        @foreach ($classes as $classe)
                            <option value="{{ $classe->id }}" {{ request('id_classe') == $classe->id ? 'selected' : '' }}>
                                Classe num {{ $classe->id }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary mt-2">Filtrer</button>
                </form>

                <table class="table table-striped" id="myTable" width="90%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Classe</th>
                            <th>Présence</th>
                            <th>Justif</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absences as $absence)
                            <tr>
                                <td>{{ $absence->date }}</td>
                                <td>{{ $absence->user->name }}</td>
                                <td><a href="mailto:{{ $absence->user->email }}">{{ $absence->user->email }}</a></td>
                                <td>
                                    @foreach ($absence->user->classes as $classe)  <!-- Utiliser 'classes' ici -->
                                        Classe num {{ $classe->id }} <!-- Affiche le numéro de la classe -->
                                    @endforeach
                                </td>
                                <td style="color: {{ $absence->presence == 'Absent' ? 'red' : 'black' }};">
                                    {{ $absence->presence }}
                                </td>
                                <td>
                                    @if ($absence->justif)
                                        <a href="{{ asset($absence->justif) }}" target="_blank">Voir la justification</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('professeur.edit', $absence->id) }}" class="btn btn-secondary">Modifier</a>
                                    <form action="{{ route('professeur.destroy', $absence->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ça ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>    
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
                    $('#myTable').DataTable( {
                        dom: 'Blfrtip',
                        lengthChange: false,
                        paging: false,
                        buttons: [{
                            extend: 'collection',
                            text: 'Export',
                            buttons: [{
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [ 0,1,2,3,4 ]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [ 0,1,2,3,4 ]
                                }
                            }],
                        }]
                    });
                });
            </script>
        </body>
    </html>
@endsection