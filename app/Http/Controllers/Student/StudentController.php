<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

use App\Models\{
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

        $eleicoes = Election::where('active', 1)->orderByDesc('year')->get();
        $eleicoes = $eleicoes->map(function ($eleicao) {
            $eleicao->hasVoted = $this->hasVoted($eleicao);
            return $eleicao;
        });

        return view('student.index', compact('eleicoes'));
    }

    public function cadastrar(): View {
        return view('student.criar');
    }

    public function urna(int $id) {
        if(!session('student')) return redirect('/');

        $eleicao = Election::findOrFail($id);
        if(!$eleicao->active) return to_route('student.index');
        
        if ($this->hasVoted($eleicao)) 
                return to_route('student.index')->with('error', 'Você já votou nessa eleição.');

        $chapas = $eleicao->candidates;

        return view('student.painel-votacao', compact('eleicao', 'chapas'));
    }

    public function salvarVoto(Request $request, Election $election) {
        if (!$election->active || !$student = Student::find($request->stdid)) 
            return response('Erro ao salvar o voto!', 404);
       
        $chapa = $election->candidates()->where('number', $request->number)->first();

        Vote::create([
            'candidate_id' => $chapa->id ?? null,
            'student_id' => $student->id,
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

    // TODO: Criar uma StudentRequest pra validação de dados.
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3|max:45',
            'registration_number' => 'required|numeric|min:1|unique:students'
        ], [
            'registration_number.required' => 'O número de matrícula é obrigatório.',
            'registration_number.min' => 'A matrícula deve ser maior ou igual a 1.',
            'registration_number.unique' => 'Já existe estudante com esta matrícula. Tente novamente.'
        ]);

        Student::create([
            'name' => $request->name,
            'registration_number' => $request->registration_number
        ]);

        return back()->withSuccess('Estudante cadastrado com sucesso!');
    }

    public function buscarChapa(Request $request, Election $election) {
        if (!$chapa = $election->candidates()->where('number', $request->number)->first()) 
            return response(null, 404);

        return response()->json($chapa);
    }

    public function destroy() {
        session()->flush();
        return to_route('student.login');
    }

    private function hasVoted(Election $eleicao) {
        return Vote::where('student_id', session('student.id'))->where('election_id', $eleicao->id)->first() !== null;
    }
}