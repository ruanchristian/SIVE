<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

use App\Models\{
    Candidate,
    Election,
    Student,
    Vote
};
use Illuminate\Http\{
    RedirectResponse,
    Request
};

class StudentController extends Controller {

    public function index(): View|RedirectResponse {
        if(!session('student')) return redirect('/');

        $eleicoes = Election::where('active', 1)->get();

        return view('student.index', compact('eleicoes'));
    }

    public function urna(int $id) {
        if(!session('student')) return redirect('/');

        $eleicao = Election::findOrFail($id);
        if(!$eleicao->active) return to_route('student.index');

        $chapas = $eleicao->candidates;

        return view('student.painel-votacao', compact('eleicao', 'chapas'));
    }

    public function salvarVoto(Request $request, Election $election) {
        $chapa = $election->candidates()->where('number', $request->number)->first();

        if (!$student = Student::find($request->stdid)) return response(null, 404);

        Vote::create([
            'candidate_id' => $chapa->id ?? null,
            'student_id' => $request->stdid,
            'election_id' => $election->id
        ]);
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

    public function buscarChapa(Request $request, Election $election) {
        $chapa = $election->candidates()->where('number', $request->number)->first();

        if (!$chapa) return response(null, 404);

        return response()->json($chapa);
    }

    public function destroy() {
        session()->flush();

        return to_route('student.login');
    }
}
