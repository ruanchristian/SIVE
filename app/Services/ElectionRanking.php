<?php

namespace App\Services;

use App\Http\Controllers\BotConfig\BotConfigController;
use App\Models\{
    Candidate,
    Election,
    User,
    Vote
};
use App\Notifications\TelegramService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class ElectionRanking {

    public function send(Election $election) {
        $user = new User;
        $msg = $this->buildMessage($election);
        Notification::send($user, new TelegramService($msg));
    }

    private function buildMessage(Election $election): string {
        $candidates = $this->getCandidatesWithVotes($election);

        $message = "*SIVE* - Ranking\n\n";
        foreach ($candidates as $idx => $candidate) {
            $per = $this->calculatePercentageByCandidate($candidate, $election);
            $message .= ($idx+1)."º lugar:\n*$candidate->name*\n$candidate->votes_count votos\n*$per%*\n\n";
        }

        return $message;
    }

    public function getCandidatesWithVotes(Election $election): Collection {
        return $election->candidates()
                    ->withCount('votes')
                    ->orderByDesc('votes_count')
                    ->orderBy('name')
                    ->get();
    }

    public function calculatePercentageByCandidate(Candidate $candidate, Election $election): float {
        $total = Vote::where('candidate_id', $candidate->id)->count();
        $totalAllVotes = Vote::where('election_id', $election->id)->count();

        $result = 0.00;
        if ($totalAllVotes > 0) {
            $result = round(($total / $totalAllVotes) * 100, 2);
        }

        return $result;
    }
}