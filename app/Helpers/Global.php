<?php

use App\Sisswa;
use App\Guru;

function ranking5Besar()
{
    $siswa = Sisswa::all();
    $siswa->map(function ($s){
        $s->rataRataNilai = $s->rataRataNilai();
    });
    $siswa = $siswa->sortByDesc('rataRataNilai')->take(5);
    return $siswa;
}

function totalSiswa()
{
    return Sisswa::count();
}
function Guru()
{
    return Guru::count();
}
