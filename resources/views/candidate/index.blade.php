<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                @if(isset($chapa))
                    Editando a chapa: {{ $chapa->name }}
                @else
                    Cadastro das chapas concorrentes ao grêmio estudantil de {{ $election->year }}
                @endif
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-4">
        @if (isset($chapa))
            <form class="space-y-3" method="POST" action="{{ route('candidate.update', $chapa->id) }}" enctype="multipart/form-data">
            @method('PUT')    
            @csrf
        @else    
           <form class="space-y-3" method="POST" action="{{ route('candidate.store', $election) }}" enctype="multipart/form-data">
        @endif
            @csrf
            <div class="space-y-2">
                <x-form.label for="name" value="Nome da chapa:" />
                <x-form.input placeholder="Insira o nome da chapa..." id="name" name="name" type="text"
                    max="30" class="block w-full" value="{{ isset($chapa) ? $chapa->name : old('name') }}" required autofocus />

                <x-form.error :messages="$errors->get('name')" />
            </div>

            <div class="space-y-2 mt-4">
                <x-form.label for="number" value="Número da chapa:" />
                <x-form.input placeholder="Número da chapa" min="10" max="99" id="number" name="number"
                    type="number" class="block w-full" value="{{ isset($chapa) ? $chapa->number : old('number') }}" required autofocus />

                <x-form.error :messages="$errors->get('number')" />
            </div>

            <div class="space-y-2 mt-4">
                <x-form.label for="image" value="Imagem da chapa:" />
                <label class="w-full flex items-center px-4 py-2 bg-white text-blue-500 rounded-md shadow-md border border-blue-500 cursor-pointer hover:bg-blue-500">
                    <span id="imgLabel" class="mr-2">Escolher imagem</span>
                    <input onchange="previewImage(event)" type="file" id="image" name="image" class="hidden" accept="image/*" />
                </label>
                <div id="imagePreview" class="mt-2">
                    @if (isset($chapa))
                      <img style="width: 11rem;" src="{{ asset($chapa->image) }}" class="mx-auto rounded" title="Logo da chapa: {{ $chapa->name }}" />
                    @endif
                </div>

                <x-form.error :messages="$errors->get('image')" />
            </div>

            <div class="flex items-center gap-4">
                <x-button class="mt-3">{{ isset($chapa) ? 'Salvar alterações' : 'Cadastrar chapa' }}</x-button>

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

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            const label = document.getElementById('imgLabel');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML =
                        `<img style="width: 11rem;" src="${e.target.result}" class="mx-auto rounded" alt="Preview da logo da chapa" />`;

                    label.textContent = input.files[0].name;
                }
                reader.readAsDataURL(input.files[0]);
            } else preview.innerHTML = '';
        }
    </script>
</x-app-layout>
