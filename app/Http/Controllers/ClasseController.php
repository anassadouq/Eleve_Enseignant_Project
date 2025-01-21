<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view('classe.index', compact('classes'));
    }

    public function create()
    {
        return view('classe.create');
    }

    public function store(Request $request)
    {
        Classe::create($request->all());
        return to_route('classe.index');
    }

    public function show(Classe $classe)
    {
        return view('classe.show', compact('classe'));
    }

    public function edit(Classe $classe)
    {
        return view('classe.edit', compact('classe'));
    }

    public function update(Request $request, Classe $classe)
    {
        $classe->update($request->all());
        return to_route('classe.index');
    }

    public function destroy(Classe $classe)
    {
        $classe->delete();
        return to_route('classe.index');
    }
}