<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Resultado Grêmio Estudantil {{ $election->year }} - EEEPJAS</title>
    <link rel="stylesheet" href="{{ asset('css/resultado.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <div class="chart-container text-center mt-16">
    <img src="{{ asset('img/eeepjas.svg') }}">
    <h1 class="text-xl font-semibold">{{ config('app.name') }}</h1>
    <h1 class="chart-title font-semibold mb-4">Resultado Oficial do Grêmio Estudantil de {{ $election->year }}</h1>
    <canvas id="chart" class="w-full"></canvas>
    <div class="ranking-list mt-6 mb-4">
        <h3 class="text-lg font-semibold mb-2">Ranking das Chapas:</h3>
        <ul id="chapa-ranking">
            @foreach ($candidates as $candidate)
                <li class="mb-2"><span class="font-semibold">{{ $loop->iteration }}º lugar:</span>
                     {{ $candidate->name }} ({{ $candidate->votes_count }} votos)
                </li>
            @endforeach
            <li class="mb-2"><span class="font-semibold">Votos brancos/nulos:</span>
                {{ $notCountable }} votos
            </li>
        </ul>
    </div><hr>
    <div class="chart-info mt-2">
      <div class="info-item"><b>Chapa vencedora:</b> {{ $candidates[0]->name }}</div>
      <div class="info-item"><b>Total de votos:</b> {{ $candidates[0]->votes_count }}</div>
      <div class="info-item"><b>Porcentagem de votos:</b> {{ $maxPercentage }}%</div>
  </div>
</div>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(() => {
            const votos = {!! json_encode(array_column($candidates->toArray(), 'votes_count')) !!};
            const chapas = {!! json_encode(array_column($candidates->toArray(), 'name')) !!};
            const chartContext = $('#chart').get(0).getContext('2d');

            let chart = new Chart(chartContext, {
                type: 'bar',
                data: {
                    labels: chapas,
                    datasets: [{
                        label: "Quantidade de votos",
                        data: votos,
                        borderWidth: 1
                    }]
                },
                options: {
                  events: [],
                  mantainAspectRatio: false,
                  responsive: true
                }
            });
            setTimeout(() => {
              window.print();
              window.history.back();
            }, 1500);
        });
    </script>
</body>
</html>