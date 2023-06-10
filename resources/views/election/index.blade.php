<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ isset($election) ? 'Editar eleição de '.$election->year : 'Crie uma nova eleição' }}
            </h2>

            @isset($election)
                <a class="text-blue-600 hover:underline" href="{{ route('candidate.index', $election) }}">Cadastrar as chapas</a>
            @endisset
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @if(isset($election))
          <form class="space-y-3" method="POST" action="{{ route('election.update', $election->id) }}">
            @method('PUT')
            @csrf
        @else
          <form class="space-y-3" method="POST" action="{{ route('election.store') }}">
            @csrf
        @endif       
            <div class="space-y-2">
                <x-form.label for="year" value="Ano da eleição:" />
                <x-form.input id="year" name="year" type="number" min="{{ date('Y') }}" class="block w-full"
                    value="{{ isset($election) ? $election->year : old('year') }}" required autofocus />

                <x-form.error :messages="$errors->get('year')" />
            </div>

            @if (isset($election))
            <div class="space-y-2 mt-4">
                <label for="active" class="block text-sm font-medium text-gray-700">Status da eleição:</label>
                <select id="active" name="active" class="block w-full h-10 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="0" {{ isset($election) && $election->active == 0 ? 'selected' : '' }}>Encerrado</option>
                    <option value="1" {{ isset($election) && $election->active == 1 ? 'selected' : '' }}>Em andamento</option>
                </select>
        
                <x-form.error :messages="$errors->get('active')" />
            </div>
        @endif

            <div class="flex items-center gap-4">
                <x-button class="mt-3">{{ isset($election) ? 'Salvar alterações' : 'Criar' }}</x-button>

                @if (session()->has('success'))
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-600 dark:text-gray-400 mt-3">
                        {{ session('success') }}
                    </p>

                @elseif (session()->has('error')) 
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                            class="text-sm text-red-600 dark:text-gray-400 mt-3">
                            {{ session('error') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</x-app-layout>