<table>
    <tr>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Tel</th>
    </tr>
    <tr>
        <td>{{ $client->nom }}</td>
        <td>{{ $client->adresse }}</td>
        <td>{{ $client->tel }}</td>
    </tr>
</table>
<a href="{{ route('client.index') }}">Retour</a>