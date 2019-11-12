<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function editnilai(Request $request,$id)
    {
        $siswa = \App\Sisswa::find($id);
        $siswa->makul()->updateExistingPivot($request->pk,['nilai' => $request->value]);
    }


// edit semester with X-edittable masi error di method
//    public function editsemester(Request $request,$id){
//        $siswa = \App\Sisswa::find($id);
//        $siswa->semester()->update($request->pk,['semester' => $request->value]);
//    }
}
