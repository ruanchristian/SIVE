<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Painel - {{ config('app.name', 'SIVE') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div x-data="mainState">
        <div class="min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200">
            <div class="flex flex-col min-h-screen lg:ml-16">
                <x-navbar />

                <header>
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <h2 class="text-xl font-semibold leading-tight">
                                Eleições em andamento
                            </h2>
                        </div>
                    </div>
                </header>

                <main class="px-4 sm:px-6 flex-1">
                    <div class="overflow-x-auto">
                        <div class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans">
                            <div class="w-full lg:w-5/6">
                                <div class="bg-white shadow-md rounded my-4">
                                    <table class="min-w-max w-full table-auto">
                                        <thead>
                                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                <th class="py-3 px-6 text-left">Eleição</th>
                                                <th class="py-3 px-6 text-left">Chapas concorrentes</th>
                                                <th class="py-3 px-6 text-center">Data de criação</th>
                                                <th class="py-3 px-6 text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 text-sm font-light">
                                            @forelse ($eleicoes as $eleicao)
                                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                    <th class="py-3 px-6 text-left">{{ $eleicao->year }}</th>
                                                    <td class="py-3 px-6 text-left">{{ $eleicao->candidates->count() }}</th>
                                                    <th class="py-3 px-6 text-center">{{ date('d/m/Y', strtotime($eleicao->created)) }}</th>
                                                    <td class="py-3 px-6 text-center">
                                                        <x-button href="{{ route('student.urna', $eleicao->id) }}" size="sm">Votar</x-button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td>
                                                    <p class="font-semibold text-red-500">Não há eleições abertas para votação.</p>
                                                </td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <x-footer />
            </div>
        </div>
    </div>
</body>
</html>