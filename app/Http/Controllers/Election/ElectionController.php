<?php

namespace App\Http\Controllers\Election;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Vote;
use App\Services\ElectionRanking;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ElectionController extends Controller {

    public function index(int $id = null): View {
        if ($id !== null) return view('election.index', ['election' => Election::findOrFail($id)]);

        return view('election.index');
    }

    public function delete(int $id)
    {
        $election = Election::find($id);

        if (!$election) {
            return back()->with('error', 'Eleição não encontrada.');
        }

        return view('election.confirm_delete', compact('election'));
    }

    public function confirmDelete(Request $request, int $id)
    {
        if(!Hash::check($request->password, auth()->user()->password)) {
            return back()->with('error', 'Sua senha está incorreta. A eleição não foi deletada.');
        }
        
        $election = Election::find($id);

        if (!$election) {
            return back()->with('error', 'Eleição não encontrada.');
        }

        if ($election->active == 1) {
            return redirect()->route('election.seeall')->with('error', 'A eleição deve estar encerrada para ser deletada.');
        }

        try {
            DB::beginTransaction();

            // Deletar votos relacionados a cada candidato da eleição
            foreach ($election->candidates as $candidate) {
                $candidate->votes()->delete();
            }

            // Deletar candidatos relacionados
            $election->candidates()->delete();

            // Deletar votos diretamente relacionados à eleição
            $election->votes()->delete();

            // Deletar a eleição
            $election->delete();

            DB::commit();

            return redirect()->route('election.seeall')->with('success', 'Eleição e candidatos relacionados deletados com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocorreu um erro ao deletar a eleição e os candidatos relacionados: ' . $e->getMessage());
        }
    }
    
    public function visualizar()
    {
        $elections = Election::orderByDesc('active')->orderBy('year')->paginate(5);

        return view('election.visualizar', compact('elections'));
    }

    public function acompanhar(int $id, bool $ajax = false) {
        $election = Election::findOrFail($id);
        $rankService = new ElectionRanking($election);
        $ranking = $rankService->getCandidatesWithVotes($election);

        $notCountable = Vote::where('election_id', $election->id)->count() - $ranking->sum('votes_count');
        $ranking->push(['name' => 'Branco/Nulo', 'votes_count' => $notCountable]);

        if ($ajax) return response()->json($ranking);

        return view('election.apuracao', compact('election', 'ranking'));
    }

    public function store(Request $request) {
        $current = date('Y');
         $request->validate([
            'year' => "required|numeric|min:$current",
            'title' => 'required|string'
        ]);

        Election::create($request->all());

        return redirect()->route('election.seeall')->with('success', 'Eleição criada com sucesso!');
    }

    public function update(Request $request, int $id) {
        if(!$election = Election::find($id)) return back()->with('error', 'Ocorreu um erro ao editar essa eleição.');

        $current = date('Y');
        $request->validate([
            'year' => "required|numeric",
            'active' => 'required|boolean',
            'title' => 'required|string'
        ],[
            'active.boolean' => 'O campo status da eleição deve estar entre [Em andamento ou Encerrado].'
        ]);
        
        $election->update($request->all());
        
        return redirect()->route('election.seeall')->with('success', 'Eleição editada com sucesso!');
    }

    public function pagina_impressao(Election $election): View {
        $rankService = new ElectionRanking($election);
        $candidates = $rankService->getCandidatesWithVotes();
        $maxPercentage = $rankService->calculatePercentageByCandidate($candidates[0]);
        $notCountable = Vote::where('election_id', $election->id)->count() - $candidates->sum('votes_count');
        
        return view('election.resultado-impressao', compact('election', 'candidates', 'maxPercentage', 'notCountable'));
    }
}