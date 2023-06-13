<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Veja as eleições cadastradas
            </h2>
        </div>
    </x-slot>

    <div class="overflow-x-auto">
        <div class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans">
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-4">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Eleição</th>
                                <th class="py-3 px-6 text-left">Chapas</th>
                                <th class="py-3 px-6 text-center">Data de criação</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($elections as $election)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <th class="py-3 px-6 text-left">{{ $election->year }}</th>
                                    <td class="py-3 px-6 text-left">{{ $election->candidates->count() }}</th>
                                    <td class="py-3 px-6 text-center">{{ date('d/m/Y', strtotime($election->created)) }}
                                    </td>
                                    <th class="py-3 px-6 text-center">
                                        <span class="{{ $election->active == 0 ? 'text-red-500' : 'text-green-600' }}">{{ $election->active == 0 ? 'Encerrada' : 'Em andamento' }}</span>
                                    </th>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <a title="Acompanhar resultados" href="{{ route('election.result', $election->id) }}">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                                                    </svg>                                                                                                            
                                                </div>
                                            </a>
                                            <a title="Editar eleição" href="{{ route('election.edit', $election->id) }}">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </div>
                                            </a>
                                            <a title="Deletar" href="#">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <td>
                                    <p class="font-semibold text-red-500">Não há eleições cadastradas no sistema.</p>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="flex justify-center p-2">
                        {!! $elections->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
</x-app-layout>
