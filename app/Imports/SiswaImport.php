<?php

namespace App\Imports;

use App\Sisswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        //key untuk mengabil baris ke berapa data itu ada dengan >=
        foreach ($collection as $key => $row ) {
            if($key >= 3 ) {
                $tanggal_lahir = ($row[7] - 25569) * 86400;
                Sisswa::create([
                    'user_id' => $row[1],
                    'nama_depan' => $row[2],
                    'nama_belakang' => ' ',
                    'falkutas' => $row[3],
                    'jenis_kelamin' => $row[4],
                    'agama' => $row[5],
                    'alamat' => $row[6],
                    'tgl_lahir' => gmdate('Y-m-d', $tanggal_lahir),
                ]);
            }
        }
    }
}
