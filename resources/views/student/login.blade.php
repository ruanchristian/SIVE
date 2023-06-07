<x-guest-layout>
    <x-auth-card>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('student-log') }}">
            @csrf
            <div class="grid gap-6">
                <div class="space-y-2">
                    <x-form.label for="matricula" value="Matrícula" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-key aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="matricula"
                            class="block w-full"
                            type="number"
                            min="1"
                            name="registration_number"
                            placeholder="Insira sua matrícula..."
                            required
                            autofocus
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <div class="flex justify-between">
                    <x-button href="{{ route('login') }}" variant="secondary" class="flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                        </svg>                          

                        <span>Voltar</span>
                    </x-button>

                    <x-button class="flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>                          

                        <span>{{ __('Log in') }}</span>
                    </x-button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>