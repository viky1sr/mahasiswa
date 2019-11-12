<?php

namespace App\Http\Controllers;

use App\Sisswa;
use App\User;
use Illuminate\Http\Request;
use App\Post;

class postController extends Controller
{
    public function index()
    {
     $posts = Post::all();
     return view('posts.index',compact(['posts']));
    }

    public function add()
    {
        return view('posts.add');
    }

    public function create(Request $request)
    {

        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',


        ]);

        $posts = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'thumbnail' => $request->thumbnail,
        ]);

        return redirect()->route('posts.index')->with('sukses', 'Data berhasil di update');
    }


    public function update(Request $request,Post $post)
    {
        //dd($request->all());
        $post->update($request->all());
        if ($request->hasFile('thumbnail')) {
            $request->file('thumbnail')->move('images/', $request->file('thumbnail')->getClientOriginalName());
            $post->thumbnail = $request->file('thumbnail')->getClientOriginalName();
            $post->save();
        }
        return redirect('/posts')->with('sukses', 'Data berhasil di update');
    }

    public function edit(Post $post)
    {
        return view('posts/edit', ['post' => $post]);
    }
    public function delete(Post $post)
    {
        $post->delete($post);
        return redirect()->back()->with('sukses','Data berhasil di hapus');
    }

}
