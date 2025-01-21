@extends('layouts.app')
@section('content')
    <head>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    </head>
    <body>
        <div class="container my-5">
            <div class="shadow p-4 mb-5 bg-white rounded" style="background-color: #f0f8ff; border: 1px solid #b0c4de;">
                <h2 class="text-center mb-4" style="color: #4682b4;">Professors and Students</h2>
                <table width="100%" class="table table-bordered table-striped text-center" id="myTable" style="border: 1px solid #b0c4de;">
                    <thead style="background-color: #4682b4; color: white;">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            @if($admin->role == "student" || $admin->role == "professeur")
                                <tr style="background-color: #e6f2ff;">
                                    <td>{{ $admin->name }}</td>
                                    <td><a href="mailto:{{ $admin->email }}" style="color: #4682b4;">{{ $admin->email }}</a></td>
                                    <td>{{ $admin->role }}</td>
                                    <td>
                                        <form action="{{ route('admin.destroy', $admin) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.edit', $admin) }}" class="btn btn-sm btn-secondary">Update</a>
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
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
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            }
                        ],
                    }]
                });
            });
        </script>
    </body>
@endsection
