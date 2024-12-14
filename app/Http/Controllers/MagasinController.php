<?php

namespace App\Http\Controllers;

use App\Models\Magasin;
use App\Http\Requests\StoreMagasinRequest;
use App\Http\Requests\UpdateMagasinRequest;

class MagasinController extends Controller
{
    public function index()
    {
        $magasins = Magasin::all();
        return view('magasin.index', compact('magasins'));
    }

    public function create()
    {
        return view('magasin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
            'tel' => 'required',
        ]);

        Magasin::create($request->all());

        return redirect()->route('magasin.index');
    }

    public function show(Magasin $magasin)
    {
        return view('magasin.show', compact('magasin'));
    }

    public function edit(Magasin $magasin)
    {
        return view('magasin.edit', compact('magasin'));
    }

    public function update(Request $request, Magasin $magasin)
    {
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
            'tel' => 'required',
        ]);

        $magasin->update($request->all());

        return redirect()->route('magasin.index');
    }

    public function destroy(Magasin $magasin)
    {
        $magasin->delete();

        return redirect()->route('magasin.index');
    }
}