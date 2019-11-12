<?php

namespace App\Http\Controllers;

use DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;

use App\Exports\SisswaExport;
use App\Imports\SiswaImport;
use App\Sisswa;
use Illuminate\Http\Request;
use App\User;
use App\Makul;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Yajra\DataTables\Contracts\DataTable;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
       if($request->has('cari')){
           $data_siswa = Sisswa::where('nama_depan','LIKE','%'.$request->cari.'%')->paginet(50);
       }else{
           $data_siswa = Sisswa::all();
       }
       return view('siswa.index',['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {

        $this->validate($request,[
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'falkutas' => 'required',
            'agama' => 'required',
            'avatar' => 'max:10240|mimes:jpg,png,jpeg,jfif',




        ]);

        //Insert ke Table User
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('admin');
        $user->remember_token = str_random(60);
        $user->save();

        //Insert ke Table SISWA !!
       $request->request->add(['user_id' => $user->id]);
        $siswa = Sisswa::create($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return redirect('/siswa')->with('sukses', 'Data berhasil ditambahkan!');
    }

    public function edit(Sisswa $siswa)
    {
        return view('siswa/edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, Sisswa $siswa)
    {
        //dd($request->all());
        $siswa->update($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data berhasil di update');
    }
    public function delete(Sisswa $siswa)
    {
//        dd($siswa->id);
        $get_id_user = Sisswa::where('id', $siswa->id)->first();
        User::where('id',$get_id_user->user_id)->delete();
        Sisswa::where('id',$get_id_user->makul_id)->delete();
        return redirect()->back()->with('sukses','Data berhasil di hapus');

    }
    public function profile(Sisswa $siswa)
    {
        $makulus = \App\Makul::all();

        //Menyiapkan data untuk chart
        $categories = [];
       $data12 = [];

        foreach ($makulus as $kepo){
            if($siswa->makul()->wherePivot('makul_id',$kepo->id)->first()) {
                $categories[] = $kepo->nama;
                $data12[] = $siswa->makul()->wherePivot('makul_id', $kepo->id)->first()->pivot->nilai;
            }
        }

        return view('siswa.profile',['siswa'=> $siswa,'makulus' => $makulus,'categories' => $categories,'data12' => $data12]);
    }
    public function addnilai(Request $request,$idsiswa)
    {
        $siswa = \App\Sisswa::find($idsiswa);
        if($siswa->makul()->where('makul_id',$request->makul)->exists()){
            return redirect('siswa/'.$idsiswa.'/profile')->with('error','Data mata pelajaran sudah ada');
        }
        $siswa->makul()->attach($request->makul,['nilai' => $request->nilai]);

        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','Nilai berhasil di tambahkan');
    }
    public function deletenilai($idsiswa,$idmakul)
    {
        $siswa = Sisswa::find($idsiswa);
        $siswa->makul()->detach($idmakul);
        return redirect()->back()->with('sukses','Data berhasil di hapus');
    }

    public function exportExcel()
    {
        return Excel::download(new SisswaExport,'Siswa.xlsx');
    }

    public function exportPDf()
    {
        $siswa = Sisswa::all();
        $pdf = PDF::loadView('export.siswapdf',['siswa' => $siswa]);
        return $pdf->download('siswa.pdf');
    }
    public function myprofile()
    {
        $siswa = auth()->user()->siswa;
        return view('siswa.myprofile',compact(['siswa']));
    }

    public function importExcel(Request $request)
    {
        Excel::import(new SiswaImport,$request->file('data_siswa'));
        return redirect()->back()->with('sukses','Data berhasil di Import');
    }

    public function getdatasiswa()
    {
        $siswa = Sisswa::select('sisswa.*');
       return \DataTables::eloquent($siswa)
           ->addColumn('nama_lengkap',function ($srow){
               return $srow->nama_depan.''.$srow->nama_belakang;
           })
           ->addColumn('rata2_nilai',function ($srow){
               return $srow->rataRataNilai();
           })
           ->addColumn('aksi',function ($srow){
               return '<a href="/siswa/'.$srow->id.'/profile" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-user"></i>Profile </a>
                       <a href="/siswa/'.$srow->id.'/edit" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                       <a href="/siswa/'.$srow->id.'/delete" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i>Delete</a>';
           })
           ->rawColumns(['nama_lengkap','rata2_nilai','aksi','checkbox'])
           ->toJson();


    }   public function html()
{
    return $this->builder()
        ->setTableId('users-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->orderBy(1)
        ->buttons(
            Button::make('create')->editor('editor'),
            Button::make('edit')->editor('editor'),
            Button::make('remove')->editor('editor'),
            Button::make('export'),
            Button::make('print'),
            Button::make('reset'),
            Button::make('reload')
        )
        ->editor(
            Editor::make()
                ->fields([
                    Fields\Text::make('name'),
                    Fields\Text::make('email'),
                    Fields\Password::make('password'),
                ])
        );
}
}

