<?php

namespace App\Http\Controllers\BotConfig;

use App\Http\Controllers\Controller;
use App\Models\BotConfig;
use App\Models\Election;
use App\Services\ElectionRanking;
use Illuminate\Http\Request;

class BotConfigController extends Controller {

    public function edit() {
        $config = BotConfig::first();
        return view('bot.edit', compact('config'));
    }

    public function update(Request $request) { 
        $data = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'frequency_minutes' => 'required|integer|min:1',
            'active' => 'required|boolean',
        ]);
        BotConfig::updateOrCreate(
            ['id' => 1],
            $data
        );

        return back()->withSuccess('Configurações do bot atualizadas com sucesso!');
    }

    public function sendReportNow(ElectionRanking $ranking) {
        $election = Election::where('active', 1)->first();

        if(!$election) return back()->withError('Nenhuma eleição ativa encontrada para enviar o relatório.');

        try {
            $ranking->send($election);
            BotConfig::updateOrCreate(
                ['id' => 1],
                ['last_sent_at' => now()]
            );
        } catch (\Throwable $e) {
            report($e);
            return back()->withError('Erro ao enviar o relatório: ' . $e->getMessage());
        }

        return back()->withSuccess('Relatório enviado com sucesso para o telegram!');
    }
}
