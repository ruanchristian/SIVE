<?php

namespace App\Http\Controllers\Election;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Vote;
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
        $candidates = $election->candidates->pluck('name')->toArray();

        $votes = [];
        foreach ($election->candidates as $candidate)
            array_push($votes, $candidate->votes->count());

        $white = Vote::where('election_id', $election->id)->count() - array_sum($votes);
        array_push($votes, $white);
        array_push($candidates, 'Branco/Nulo');

        if ($ajax) {
            $rank = array_map(function ($chapa, $votos) {
                return [
                    'chapa' => $chapa,
                    'votos' => $votos
                ];
            }, $candidates, $votes);
            
            return response()->json($rank);
        }

        return view('election.apuracao', compact('election', 'votes', 'candidates'));
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
}
