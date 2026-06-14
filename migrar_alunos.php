<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// migrando alunos da 1ª série EEEPJAS do SIGA para o SIVE;
// foi configurado o arquivo: config/databases.php
DB::connection('epqu3536_siga')->table('students')->where('school_year', '1ª Série')->orderBy('id')->chunk(200, function ($students) {
    $arr = $students->map(function ($std) {
        return [
            'name' => $std->name,
            'registration_number' => $std->registration_number
        ];
    });
    // mysql -> referência ao banco de dados do sive.
    DB::connection('mysql')->table('students')->insert($arr->toArray());
});

echo 'Alunos migrados com sucessos na base da dados do SIGA!';