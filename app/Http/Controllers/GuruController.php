<?php

namespace App\Http\Controllers;

use App\Post;
use App\Sisswa;
use Illuminate\Http\Request;
use App\Guru;

class GuruController extends Controller
{
    public function index()
    {
    $guru = Post::all();
    return view('guru.index',compact(['guru']));
    }

    public function profile($id)
    {
        $guru = Guru::find($id);
        return view('guru.profile',['guru' => $guru]);
    }

    public function getdataguru()
    {
        $guru = Guru::select('guru.*');
        return \DataTables::eloquent($guru)
            ->addColumn('aksi',function ($srow){
                return '<a href="/guru/'.$srow->id.'/profile" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-user"></i>Profile </a>
                       <a href="/guru/'.$srow->id.'/edit" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                       <a href="#" class="btn btn-danger btn-sm delete" siswa-id="'.$srow->id.'"><i class="glyphicon glyphicon-remove"></i>Delete</a>';
            })
            ->addColumn('checkbox','<input type="checkbox" name="srow_checkbox[]" class="srow_checkbox" value="{{$id}}" >')
            ->rawColumns(['aksi','checkbox'])
            ->toJson();


    }
}
