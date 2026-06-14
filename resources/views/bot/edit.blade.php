<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Configuração de envio de relatórios ao telegram
            </h2>

            <form method="POST" action="{{ route('bot.sendNow') }}" class="flex items-center gap-4">
                @csrf

                <x-button onclick="return confirm('Deseja enviar o relatório no grupo do telegram agora?')">
                    Enviar Relatório Agora
                </x-button>
            </form>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-4">

        <form class="space-y-4" method="POST" action="{{ route('bot.update') }}">

            @csrf
            @method('PUT')

            <div class="space-y-2">
                <x-form.label for="start_time" value="Horário inicial" />

                <x-form.input id="start_time" name="start_time" type="time" class="block w-full"
                    value="{{ old('start_time', $config?->start_time ? $config->start_time->format('H:i') : '') }}"
                    required />

                <x-form.error :messages="$errors->get('start_time')" />
            </div>

            <div class="space-y-2">
                <x-form.label class="mt-2" for="end_time" value="Horário final" />

                <x-form.input id="end_time" name="end_time" type="time" class="block w-full"
                    value="{{ old('end_time', $config?->end_time ? $config->end_time->format('H:i') : '') }}" required />

                <x-form.error :messages="$errors->get('end_time')" />
            </div>

            <div class="space-y-2">
                <x-form.label class="mt-2" for="frequency" value="Intervalo de envio" />

                <select id="frequency" name="frequency_minutes"
                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600">

                    <option value="5" {{ old('frequency', $config?->frequency_minutes ?? '') == 5 ? 'selected' : '' }}>
                        A cada 5 minutos
                    </option>

                    <option value="10" {{ old('frequency', $config?->frequency_minutes ?? '') == 10 ? 'selected' : '' }}>
                        A cada 10 minutos
                    </option>

                    <option value="15" {{ old('frequency', $config?->frequency_minutes ?? '') == 15 ? 'selected' : '' }}>
                        A cada 15 minutos
                    </option>

                    <option value="30" {{ old('frequency', $config?->frequency_minutes ?? '') == 30 ? 'selected' : '' }}>
                        A cada 30 minutos
                    </option>

                    <option value="60" {{ old('frequency', $config?->frequency_minutes ?? '') == 60 ? 'selected' : '' }}>
                        A cada 1 hora
                    </option>

                </select>

                <x-form.error :messages="$errors->get('frequency')" />
            </div>

            <div class="space-y-2">
                <x-form.label class="mt-2" for="active" value="Status" />

                <select id="active" name="active"
                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600">

                    <option value="1" {{ old('active', $config?->active ?? 1) == 1 ? 'selected' : '' }}>
                        Ativo
                    </option>

                    <option value="0" {{ old('active', $config?->active ?? 1) == 0 ? 'selected' : '' }}>
                        Inativo
                    </option>

                </select>

                <x-form.error :messages="$errors->get('active')" />
            </div>

            <div class="mt-4 text-sm text-gray-600">
                Último envio:
                {{ $config?->last_sent_at?->format('d/m/Y H:i:s') ?? 'Nunca enviado' }}
            </div>

            <div class="flex items-center gap-4">

                <x-button class="mt-3">
                    Salvar configurações
                </x-button>

                @if (session()->has('success'))
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                        class="text-sm text-green-600 mt-3">

                        {{ session('success') }}
                    </p>
                @endif

                @if (session()->has('error'))
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                        class="text-sm text-red-600 mt-3">

                        {{ session('error') }}
                    </p>
                @endif

            </div>

        </form>
    </div>
</x-app-layout>
