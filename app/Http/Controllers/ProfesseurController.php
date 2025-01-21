<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absence;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    public function index(Request $request)
    {
        $professeur = auth()->user();
        $classes = $professeur->classes;
        // Initialisation de la requête Absence
        $absences = Absence::with('user');

        // Si une classe est sélectionnée, filtrer les absences des étudiants de cette classe
        if ($request->has('id_classe') && $request->input('id_classe') != '') {
            $classeId = $request->input('id_classe');
            $absences = $absences->whereHas('user.classes', function ($query) use ($classeId) {
                $query->where('classe_users.id_classe', $classeId);  // Filtrage par la table pivot
            });
        }

        // Récupérer les absences filtrées
        $absences = $absences->get();

        // Retourner la vue avec les absences et les classes
        return view('professeur.index', compact('absences', 'classes'));
    }

    public function create(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $professeur = auth()->user();

        // Récupérer toutes les classes du professeur pour le filtrage
        $classes = $professeur->classes; // Notez que j'ai modifié `classe` en `classes` pour refléter une relation plusieurs-à-plusieurs

        // Initialiser la requête pour récupérer les étudiants
        $studentsQuery = User::where('role', 'student')
            ->whereHas('classes', function ($query) use ($professeur) {
                $query->whereIn('id_classe', $professeur->classes->pluck('id'));
            });

        // Si une classe est sélectionnée, filtrer les étudiants par classe
        if ($request->has('classe_id') && $request->input('classe_id') != '') {
            $studentsQuery->whereHas('classes', function ($query) use ($request) {
                $query->where('id_classe', $request->input('classe_id'));
            });
        }

        // Récupérer les étudiants après filtrage
        $students = $studentsQuery->get();

        return view('professeur.create', compact('students', 'classes'));
    }





    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'matiere' => 'required|string',
            'presence' => 'required|array',
            'presence.*' => 'required|string',
        ]);

        $date = $request->date;
        $matiere = $request->matiere;

        foreach ($request->presence as $studentId => $presenceText) {
            Absence::create([
                'id_user' => $studentId,
                'date' => $date,
                'matiere' => $matiere,
                'presence' => $presenceText,
                'justif' => null,
            ]);
        }

        return redirect('/professeur');
    }

    public function edit(Absence $absence)
    {
        return view('professeur.edit', compact('absence'));
    }

    public function update(Request $request, Absence $absence)
    {
        $request->validate([
            'date' => 'required|date',
            'presence' => 'required|string',
        ]);

        $absence->update($request->only('date', 'presence'));
        return redirect()->route('professeur.index')->with('success', 'Absence mise à jour avec succès !');
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();

        return redirect()->route('professeur.index')->with('success', 'Absence supprimée avec succès!');
    }
}