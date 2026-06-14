<?php

namespace App\Console\Commands;

use App\Models\{BotConfig, Election};
use App\Services\ElectionRanking;
use Illuminate\Console\Command;

class SendElectionRankCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string  
     */
    protected $signature = 'ranking:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia o ranking da eleição ativa para o Telegram.';

    /**
     * Execute the console command.
     */
    public function handle(ElectionRanking $rank): int
    {
        $config = BotConfig::first();
        if(!$config || !$config->active) {
            $this->info('Bot inativo. Nenhum relatório enviado.');
            return self::SUCCESS;
        }

        $agora = now();
        $currentTime = $agora->format('H:i');
        $startTime = $config->start_time->format('H:i');
        $endTime = $config->end_time->format('H:i');

        if($currentTime < $startTime || $currentTime > $endTime) {
            $this->info('Fora do horário de envio. Nenhum relatório enviado.');
            return self::SUCCESS;
        }

        if($agora->minute % $config->frequency_minutes !== 0) {
            $this->info('Não é hora de enviar o relatório. Nenhum relatório enviado.');
            return self::SUCCESS;
        }

        $eleicao = Election::where('active', 1)->first();
        if(!$eleicao) {
            $this->info('Nenhuma eleição ativa encontrada. Nenhum relatório foi enviado pro telegram.');
            return self::SUCCESS;
        }

        // if($config->last_seen_at && $config->last_seen_at->format('Y-m-d H:i') === $agora->format('Y-m-d H:i')) {
        //     $this->info('Relatório já enviado recentemente.');
        //     return self::SUCCESS;
        // }

        $rank->send($eleicao);
        $config->update(['last_sent_at' => $agora]);

        $this->info('Relatório enviado com sucesso para o telegram!');
        return self::SUCCESS; 
    }
}
