<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Resultados da eleição de {{ $election->year }}
            </h2>
            <span class="font-semibold {{ $election->active ? 'text-green-600 inline-block' : 'text-red-500' }}">
                @if ($election->active)
                    Em andamento...
                    <div class="custom-loader"></div>
                @else
                    Eleição encerrada!
                @endif
            </span>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-4">
        @if ($election->candidates->isNotEmpty())
            <h3 class="text-lg font-semibold leading-tight mb-4">Ranking {{ $election->active ? 'em tempo real' : '' }}
            </h3>
            <ol class="pl-4" id="ranking-list"></ol>
        @else
            <span class="text-red-500">Não há chapas cadastradas para essa eleição.</span>
            <a class="text-blue-500 hover:underline" href="{{ route('candidate.index', $election) }}">Clique aqui para cadastrar</a>
        @endif
    </div>

    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <div class="bg-white rounded-lg shadow-lg">
                <canvas height="300px" id="grafico1"></canvas>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-lg shadow-lg ">
                <canvas height="300px" id="grafico2"></canvas>
            </div>
        </div>
    </div>

    <input type="hidden" id="elecId" data-value="{{ $election->id }}" data-isactive="{{ $election->active }}">

    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.1/gsap.min.js" integrity="sha512-qF6akR/fsZAB4Co1QDDnUXWnaQseLGXoniuSuSlPQK6+aWhlMZcHzkasCSlnWoe+TJuudlka1/IQ01Dnhgq95g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/resultado.js') }}"></script>

    <script>
        const donutCanvas = $('#grafico1').get(0).getContext('2d');
        const barCanvas = $('#grafico2').get(0).getContext('2d');
        const chapas = {!! json_encode($candidates, JSON_HEX_TAG) !!};
        const votos = {!! json_encode($votes, JSON_HEX_TAG) !!};

        window.barChart = new Chart(barCanvas, {
            type: 'bar',
            data: {
                labels: chapas,
                datasets: [{
                    label: 'Votos',
                    data: votos,
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true
            }
        });

        window.donutChart = new Chart(donutCanvas, {
            type: 'pie',
            data: {
                labels: chapas,
                datasets: [{
                    label: 'Votos',
                    data: votos,
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true
            }
        });
    </script>
</x-app-layout>
