<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Classe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::all();
        return view('admin.index', compact('admins'));
    }

    public function edit(User $admin)
    {
        $admin->load('classes'); // Charge les classes associées à l'utilisateur
        $classes = Classe::all(); // Obtenir toutes les classes disponibles
        return view('admin.edit', compact('admin', 'classes'));
    }
    
    
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'role' => 'required|string',
            'classes' => 'array|exists:classes,id', // Validation des classes
        ]);
     
        $admin->update($request->only('name', 'email', 'role'));
        
        // Lier ou détacher les classes associées à cet utilisateur
        $admin->classes()->sync($request->input('classes', []));
     
        return redirect()->route('admin.index')->with('success', 'Absence mise à jour avec succès !');
    }    
    

    public function destroy(User $admin)
    {
        $admin->delete();
        return to_route('admin.index');
    }
}