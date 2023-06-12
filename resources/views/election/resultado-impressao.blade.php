<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Resultado Grêmio Estudantil {{ $election->year }} - EEEPJAS</title>
    <link rel="stylesheet" href="{{ asset('css/resultado.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <div class="chart-container text-center mt-16">
    <h2 class="chart-title text-xl font-semibold mb-4">Resultado Oficial do Grêmio Estudantil de {{ $election->year }}</h2>
    <canvas id="chart" class="w-full"></canvas>
    <div class="ranking-list mt-6 mb-4">
        <h3 class="text-lg font-semibold mb-2">Ranking das Chapas:</h3>
        <ul id="chapa-ranking">
            <li class="mb-2"><span class="font-semibold">1º lugar</span> Chapa 2 (40 votos)</li>
            <li class="mb-2"><span class="font-semibold">2º lugar</span> Chapa 1 (35 votos)</li>
            <li class="mb-2"><span class="font-semibold">3º lugar</span> Chapa 3 (25 votos)</li>
        </ul>
    </div><hr>
    <div class="chart-info mt-2">
      <div class="info-item"><b>Chapa vencedora:</b> Chapa 2</div>
      <div class="info-item"><b>Total de votos:</b> 100</div>
      <div class="info-item"><b>Porcentagem de votos:</b> 35%</div>
  </div>
</div>

    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(() => {
            const chartData = [35, 40, 25];
            const chartLabels = ['Chapa 1', 'Chapa 2', 'Chapa 3'];

            const chartCanvas = document.getElementById('chart');
            const chartContext = chartCanvas.getContext('2d');

            let chart = new Chart(chartContext, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        data: chartData,
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