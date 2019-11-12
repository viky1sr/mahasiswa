@extends('layout/main');

@section('kepo')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Edit Data Siswa</h3>
                            </div>
                            <div class="panel-body">
                                <form action="/siswa/{{$siswa->id}}/update" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-grup">
                                        <label for="exampleInputEmaill">Nama Depan</label>
                                        <input name="nama_depan" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{$siswa->nama_depan}}">
                                    </div>

                                    <div class="form-grup">
                                        <label for="exampleInputEmaill">Nama Belakang</label>
                                        <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{$siswa->nama_belakang}}">
                                    </div>

                                    <div class="form-grup">
                                        <label for="exampleInputEmaill">Falkutas</label>
                                        <input name="falkutas" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="falkutas" value="{{$siswa->falkutas}}">
                                    </div>

                                    <div class="form-grup">
                                        <label for="exampleFormControlSelectl">Pilih Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelectl">
                                            <option value="L @if($siswa->jenis_kelamin == 'L')  @endif">Laki-Laki</option>
                                            <option value="P @if($siswa->jenis_kelamin == 'P') @endif">Perempuan</option>

                                        </select>
                                    </div>

                                    <div class="form-grup {{$errors->has('agama') ? 'has-error' : ''}}">
                                        <label for="exampleFormControlSelectl" >Agama</label>
                                        <select name="agama" class="form-control" id="exampleFormControlSelectl">
                                            <option value="Islam @if($siswa->agama == 'Islam')  @endif">Islam</option>
                                            <option value="Kristen @if($siswa->agama == 'Kristen')  @endif">Krsiten</option>
                                            <option value="Katolik @if($siswa->agama == 'Katolik')  @endif">Katolik</option>
                                            <option value="Hindu @if($siswa->agama == 'Hindu')  @endif">Hindu</option>
                                            <option value="Budha @if($siswa->agama == 'Budha')  @endif">Budha</option>
                                        </select>
                                        @if($errors->has('agama'))
                                            <span class="help-block">{{$errors->first('agama')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-grup">
                                        <label for="exampleInputEmaill">Tgl Lahir</label>
                                        <input name="tgl_lahir" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Tgl Lahir" value="{{$siswa->tgl_lahir}}">
                                    </div>

                                    <div class="form-grup">
                                        <label for="exampleFormControlTextareal">Alamat</label>
                                        <textarea name="alamat" class="form-control" id="exampleFormControlTextareal" rows="3">{{$siswa->alamat}}</textarea>
                                    </div>
                                    <div class="form-grup">
                                        <label for="exampleFormControlTextareal">Avatar</label>
                                        <input type="file" name="avatar" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 @stop
@section('kepo1')

    <h1>Edit Data Siswa</h1>
    @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
    @endif
    @endsection
