<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Candidate,
    Student
};

class StudentController extends Controller {

    public function index() {
        if (!session('student')) return redirect('/');

        return view('student.painel-votacao', compact('chapas'));
    }
    
    public function login(Request $request) {
        $request->validate([
            'registration_number' => 'required|numeric|min:1'
        ], [
            'registration_number.required' => 'O número de matrícula é obrigatório.',
            'registration_number.min' => 'A matrícula deve ser maior ou igual a 1.'
        ]);
 
        $student = Student::where('registration_number', $request->registration_number)->first();

        if(!$student) return back()->withErrors(['not_exists' => 'Essa matrícula não existe!']);

        $request->session()->put('student', [
            'id' => $student->id,
            'name' => $student->name
        ]);

        return to_route('student.index');
    }

    public function destroy() {
        session()->flush();

        return to_route('student.login');
    }
}
