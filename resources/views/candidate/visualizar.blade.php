<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Chapas cadastradas
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
                                <th class="py-3 px-6 text-left">Chapa</th>
                                <th class="py-3 px-6 text-left">Nº da chapa</th>
                                <th class="py-3 px-6 text-center">Eleição pertencente</th>
                                <th class="py-3 px-6 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($candidates as $chapa)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <th class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                <img width="28" height="28" src="{{ asset($chapa->image) }}" alt="Logo: {{ $chapa->name }}">
                                            </div>
                                            <span class="font-medium">{{ $chapa->name }}</span>
                                        </div>
                                    </th>
                                    <td class="py-3 px-6 text-left">{{ $chapa->number }}</th>
                                    <th class="py-3 px-6 text-center">{{ $chapa->election->year }}</th>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <a title="Editar chapa" href="{{ route('candidate.edit', $chapa->id) }}">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </div>
                                            </a>
                                            <a title="Deletar" href="javascript:void(0);">
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
                                    <p class="font-semibold text-red-500">Não há chapas cadastradas no sistema.</p>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="flex justify-center p-2">
                        {!! $candidates->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
</x-app-layout>
