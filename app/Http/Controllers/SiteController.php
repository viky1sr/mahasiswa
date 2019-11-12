<?php

namespace App\Http\Controllers;

use App\Sisswa;
use App\User;
use Illuminate\Http\Request;
use App\Post;

class SiteController extends Controller
{
    public function home(){
        $posts = Post::all();
        return view('sites.home',compact('posts'));
    }
    public function about(){
        return view('sites.about');
    }
    public function register(){
        return view('sites.register');
    }
    public function postregister(Request $request){

        $this->validate($request,[
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'max:10240|mimes:jpg,png,jpeg,jfif',
        ]);

        //input pendaftaran sebagai user dulu
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = str_random(60);
        $user->save();

        $request->request->add(['user_id' => $user->id]);
        $siswa = Sisswa::create($request->all());

        return redirect('/')->with('sukses', 'Data pendaftaran berhasil di kirim');
    }

    public function singlepost($slug)
    {
        $post = Post::where('slug','=',$slug)->first();
        return view('sites.singlepost',compact(['post']));
    }
}
