<form action="{{ route('admin.update', $admin) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="nom">Nom:</label>
    <input type="text" name="name" value="{{ $admin->name }}"><br><br>

    <label for="adresse">Email:</label>
    <input type="text" name="email" value="{{ $admin->email }}"><br><br>

    <label for="role">Role:</label>
    <select name="role">
        <option value="student" {{ $admin->role == 'student' ? 'selected' : '' }}>Student</option>
        <option value="professeur" {{ $admin->role == 'professeur' ? 'selected' : '' }}>Professeur</option>
    </select><br><br>

    <label for="classes">Classes:</label>
    <select name="classes[]" multiple>
        @foreach($classes as $classe)
            <option value="{{ $classe->id }}" {{ in_array($classe->id, $admin->classes->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $classe->name }}
            </option>
        @endforeach
    </select><br><br>

    <input type="submit" value="Update">
</form>
