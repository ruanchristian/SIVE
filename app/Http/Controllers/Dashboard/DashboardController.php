<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BotConfig;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Vote;

class DashboardController extends Controller {

    public function index() {
        $stats = [
            'elections' => Election::count(),
            'candidates' => Candidate::count(),
            'votes' => Vote::count(),
            'activeElection' => Election::where('active', 1)->first(),
        ];

        $botConfig = BotConfig::first();
        return view('dashboard', compact('botConfig', 'stats'));
    }
}