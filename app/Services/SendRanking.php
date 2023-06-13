<?php

namespace App\Services;

use App\Models\{
    Election,
    User
};
use App\Notifications\TelegramService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class SendRanking {
    
    private Election $election;

    public function __construct(Election $election) {
        $this->election = $election;
    }

    public function __invoke() {
        $this->sendRankingMessage();
    }

    public function sendRankingMessage(): void {
        $user = new User;
        $candidates = $this->getCandidatesWithVotes();

        $message = "*SIVE* - Ranking Grêmio *".$this->election->year."*:\n\n";
        foreach ($candidates as $idx => $candidate) {
            $message .= ($idx+1)."º lugar:\n*$candidate->name*\n$candidate->votes_count votos\n\n";
        }

        Notification::send($user, new TelegramService($message));
    }

    public function getCandidatesWithVotes(): Collection {
        return $this->election->candidates()
                    ->withCount('votes')
                    ->orderByDesc('votes_count')
                    ->get();
    }
}