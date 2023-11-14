<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Cadastro dos estudantes
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-4">
        <form class="space-y-3" method="POST" action="{{ route('student.save-student') }}">
            @csrf
            <div class="space-y-2">
                <x-form.label for="name" value="Nome completo:" />
                <x-form.input placeholder="Insira o nome do estudante..." id="name" name="name" type="text"
                    max="45" class="block w-full" value="{{ old('name') }}"
                    required autofocus />

                <x-form.error :messages="$errors->get('name')" />
            </div>

            <div class="space-y-2 mt-4">
                <x-form.label for="matricula" value="Número da matrícula:" />
                <x-form.input placeholder="Matrícula" min="1" id="matricula" name="registration_number"
                    type="number" class="block w-full" value="{{ old('registration_number') }}"
                    required autofocus />

                <x-form.error :messages="$errors->get('registration_number')" />
            </div>

            <div class="flex items-center gap-4">
                <x-button class="mt-3">Cadastrar</x-button>

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
