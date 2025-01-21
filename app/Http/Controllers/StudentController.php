<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $absences = Absence::where('id_user', $user->id)->with('user')->get();
        return view('student.index', compact('absences'));
    }    

    public function create()
    {
        $students = User::where('role', 'student')->get();
        return view('student.create', compact('students'));//student inclus
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'matiere' => 'required|string',
            'presence' => 'required|array',
            'presence.*' => 'required|string',
            'justif' => 'nullable|array',
        ]);
    
        $date = $request->date;
        $matiere = $request->matiere;
    
        foreach ($request->presence as $studentId => $presenceText) {
            Absence::create([
                'id_user' => $studentId,
                'date' => $date,
                'matiere' => $matiere,
                'presence' => $presenceText,
                'justif' => $presenceText === 'non' ? ($request->justif[$studentId] ?? null) : null,
            ]);
        }
    
        return redirect('/student')->with('success', 'Absences recorded successfully!');
    }

    public function edit(Absence $absence)
    {
        return view('student.edit', ['absence' => $absence]);
    }
    
    public function update(Request $request, Absence $absence)
    {
        $request->validate([
            'justif' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);
    
        if ($request->hasFile('justif')) {
            $fileName = time() . '_' . $request->file('justif')->getClientOriginalName();
            $request->file('justif')->move(public_path('images'), $fileName); //aytstocka f folder smitp public/images
    
            $absence->justif = 'images/' . $fileName;
        }
        $absence->save();
        return redirect()->route('student.index')->with('success', 'Absence mise à jour avec succès !');
    }          
}