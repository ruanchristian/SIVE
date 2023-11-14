<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tela de Votação - {{ config('app.name', 'SIVE') }}</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

    <link rel="preload" href="{{ asset('css/urna.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/urna.css') }}">
    </noscript>

    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
</head>

<body class="font-sans">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand">
                <img width="60rem" src="{{ asset('img/logo.png') }}">
                Sistema de Votação Escolar
            </span>
            <span class="d-flex">Bem vindo(a): <strong>{{ session('student.name') }}</strong></span>
        </div>
    </nav>

    <div class="container mt-3 mb-3 py-3">
        <div class="col-12">
            <div class="row">
                <h5 class="col-12 text-center font-weight-bold mb-4">Candidatos ao Grêmio Estudantil -
                    {{ $eleicao->year }}</h5>
                @foreach ($chapas as $chapa)
                    <div class="col-4 text-center">
                        <span class="d-block">{{ $chapa->name }} - <b>{{ $chapa->number }}</b></span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-12 my-4 urna rounded">
            <div class="row">
                <div class="col-md-6">
                    <div class="row desktop py-4 m-3">
                        <div id="fim" class="text-center">
                            <h1 class="mt-5">FIM</h1>
                            <p class="my-3 mx-4">Seu voto foi contabilizado.</p>
                            <p class="my-3 mx-4 font-weight-bold">O próximo eleitor poderá votar em <span
                                    id="count">5</span> segundos...</p>
                        </div>
                        <div class="content">
                            <div class="col-12">
                                <div class="row" style="position:relative;">
                                    <div class="offset-4 col-8">
                                        <h4 class="text-uppercase font-weight-bold">Chapa:</h4>
                                        <img src="{{ asset('img/default.png') }}" class="img-fluid mb-2 foto-chapa"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="text-uppercase font-weight-bold">número:</p>
                                    </div>
                                    <div class="col-3 col-lg-2">
                                        <input type="text"
                                            class="form-control input-dezena font-weight-bold text-uppercase text-center"
                                            disabled>
                                    </div>
                                    <div class="col-3 col-lg-2">
                                        <input type="text"
                                            class="form-control input-unidade font-weight-bold text-uppercase text-center"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="text-uppercase font-weight-bold">nome:</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="text"
                                            class="form-control nome-chapa font-weight-bold text-uppercase nome-canditato"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row teclas m-3">
                        @for ($i = 1; $i <= 9; $i++)
                            <div class="col-4 text-center number mt-2">
                                <button
                                    class="col-12 btn btn-secondary font-weight-bold btn-number">{{ $i }}</button>
                            </div>
                        @endfor
                        <div class="col-md-4 text-center offset-md-4 number mt-2 mb-3">
                            <button class="col-12 btn btn-secondary font-weight-bold btn-number">0</button>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <button
                                        class="col-12 text-center text-uppercase btn font-weight-bold btn-secondary btn-branco">branco</button>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <button
                                        class="col-12 text-center btn btn-secondary text-uppercase font-weight-bold btn-corrige">corrigir</button>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <button
                                        class="col-12 text-center btn btn-secondary text-uppercase font-weight-bold btn-confirma">confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <audio id="confirma" src="{{ asset('audios/confirma.mp3') }}"></audio>
    <audio id="tecla" src="{{ asset('audios/typing.mp3') }}"></audio>
    <input type="hidden" id="rota" data-urlsearch="{{ route('student.buscar-chapa', $eleicao) }}"
        data-urlsavevote="{{ route('student.vote', $eleicao) }}" data-stdid="{{ session('student.id') }}">

    <div class="text-center fixed-bottom p-3 bg-light">
        Developed by:
        <u class="text-reset fw-bold">Ruan Christian</u> ©
    </div>
</body>

<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/urna.js') }}"></script>

</html>
