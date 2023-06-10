<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRequest;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller {
    
    public function index(Election $election) {
        if (!$election) return back()->with('error', 'erro no redirecionamento!');

        return view('candidate.index', compact('election'));
    }

    public function edit(int $id) {
        if (!$chapa = Candidate::find($id)) return to_route('candidate.seeall');

        return view('candidate.index', compact('chapa'));
    }

    public function visualizar(): View {
        $candidates = Candidate::paginate(6);

        return view('candidate.visualizar', compact('candidates'));
    }

    public function store(CandidateRequest $request, Election $election) {
        if(!$election) return back()->with('error', 'Erro ao criar chapa.');

        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->number = $request->number;
        $candidate->image = 'storage/'. $request->image->store('img/chapas', 'public');

        $election->candidates()->save($candidate);

        return back()->with('success', 'Chapa adicionada com sucesso!');
    }

    public function update(CandidateRequest $request, int $id) {
        if (!$chapa = Candidate::find($id)) return back()->with('error', 'Erro ao salvar alterações');

        $chapa->update($request->except(['image']));

        if ($request->hasFile('image')) {
            $oldPath = public_path($chapa->image);
            if (file_exists($oldPath)) unlink($oldPath);
        
            $chapa->image = 'storage/' . $request->image->store('img/chapas', 'public');
            $chapa->save();
        }

        return back()->with('success', 'Chapa alterada com sucesso!!');
    }
}
