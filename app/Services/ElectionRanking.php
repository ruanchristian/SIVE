<?php

namespace App\Services;

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
    
    private Election $election;

    public function __construct(Election $election) {
        $this->election = $election;
    }

    public function __invoke() {
        $this->sendMessage();
    }

    private function sendMessage(): void {
        $user = new User;
        $candidates = $this->getCandidatesWithVotes();

        $message = "*SIVE* - Ranking Grêmio *".$this->election->year."*:\n\n";
        foreach ($candidates as $idx => $candidate) {
            $per = $this->calculatePercentageByCandidate($candidate);
            $message .= ($idx+1)."º lugar:\n*$candidate->name*\n$candidate->votes_count votos\n*$per%*\n\n";
        }

        Notification::send($user, new TelegramService($message));
    }

    public function getCandidatesWithVotes(): Collection {
        return $this->election->candidates()
                    ->withCount('votes')
                    ->orderByDesc('votes_count')
                    ->orderBy('name')
                    ->get();
    }

    public function calculatePercentageByCandidate(Candidate $candidate): float {
        $total = Vote::where('candidate_id', $candidate->id)->count();
        $totalAllVotes = Vote::where('election_id', $this->election->id)->count();

        $result = 0.00;
        if ($totalAllVotes > 0) {
            $result = round(($total / $totalAllVotes) * 100, 2);
        }

        return $result;
    }
}