<main class="flex flex-col items-center flex-1 px-4 pt-6 sm:justify-center">
    <div>
        <img style="width: 9rem;" src="{{ asset('img/eeepjas.svg') }}" alt="Logo da Escola">

        <h1 class="text-center">
            <strong class="hover:underline" title="{{ config('app.description') }}" style="font-size: 1.5rem;">{{ config('app.name') }}</strong>
            @if(Route::currentRouteName() == 'student.login')
                <p>Entre para votar!</p>
            @endif
        </h1>

    </div>

    <div class="w-full px-6 py-4 my-6 overflow-hidden bg-white rounded-md shadow-md sm:max-w-md dark:bg-dark-eval-1">
        {{ $slot }}
    </div>
</main>