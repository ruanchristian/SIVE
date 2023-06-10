<?php

namespace App\Http\Controllers\Election;

use App\Http\Controllers\Controller;
use App\Models\Election;
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

    public function acompanhar(int $id): View {
        $election = Election::findOrFail($id);

        return view('election.apuracao', compact('election'));
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
