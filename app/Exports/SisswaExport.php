<?php

namespace App\Exports;

use App\Sisswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;



class SisswaExport implements FromCollection,WithMapping,WithHeadings

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sisswa::all();
    }

    public function map($siswa): array
    {
        return [
            $siswa->user_id,
            $siswa->nama_lengkap(),
            $siswa->falkutas,
            $siswa->jenis_kelamin,
            $siswa->agama,
            $siswa->alamat,
            $siswa->tgl_lahir,
        ];
    }

    public function headings(): array
    {
        return [
            'USER_ID',
            'NANA',
            'FALKUTAS',
            'JENIS KELAMIN',
            'AGAMA',
            'ALAMAT',
            'TGL LAHIR',
        ];
    }
}
