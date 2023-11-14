<?php

namespace App\Http\Controllers\Election;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Vote;
use App\Services\ElectionRanking;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ElectionController extends Controller {

    public function index(int $id = null): View {
        if ($id !== null) return view('election.index', ['election' => Election::findOrFail($id)]);

        return view('election.index');
    }
    
    public function visualizar(): View {
        $elections = Election::orderByDesc('active')->orderBy('year')->paginate(5);

        return view('election.visualizar', compact('elections'));
    }

    public function acompanhar(int $id, bool $ajax = false) {
        $election = Election::findOrFail($id);
        $rankService = new ElectionRanking($election);
        $ranking = $rankService->getCandidatesWithVotes();

        $notCountable = Vote::where('election_id', $election->id)->count() - $ranking->sum('votes_count');
        $ranking->push(['name' => 'Branco/Nulo', 'votes_count' => $notCountable]);

        if ($ajax) return response()->json($ranking);

        return view('election.apuracao', compact('election', 'ranking'));
    }

    public function store(Request $request) {
        $current = date('Y');
        $request->validate([
            'year' => "required|numeric|min:$current|unique:elections"
        ]);

        Election::create($request->all());

        return back()->with('success', 'Eleição criada com sucesso!');
    }

    public function update(Request $request, int $id) {
        if(!$election = Election::find($id)) return back()->with('error', 'Ocorreu um erro ao editar essa eleição.');

        $current = date('Y');
        $request->validate([
            'year' => "required|numeric|min:$current|unique:elections,year,$id,id",
            'active' => 'required|boolean'
        ],[
            'active.boolean' => 'O campo status da eleição deve estar entre [Em andamento ou Encerrado].'
        ]);
        
        $election->update($request->all());
        
        return back()->with('success', 'Eleição editada com sucesso!');
    }

    public function pagina_impressao(Election $election): View {
        $rankService = new ElectionRanking($election);
        $candidates = $rankService->getCandidatesWithVotes();
        $maxPercentage = $rankService->calculatePercentageByCandidate($candidates[0]);
        $notCountable = Vote::where('election_id', $election->id)->count() - $candidates->sum('votes_count');
        
        return view('election.resultado-impressao', compact('election', 'candidates', 'maxPercentage', 'notCountable'));
    }
}