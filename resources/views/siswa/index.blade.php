@extends('layout/main');
@section('kepo')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="font-weight-bold">Data Mahasiswa</h3>
                                <div class="right">
                                    <a href="#" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#importSiswa">Import XLS</a>
                                    <a href="/siswa/exportexcel" class="btn btn-sm btn-primary">Export Excel</a>
                                    <a href="/siswa/exportpdf" class="btn btn-sm btn-primary">Export PDF</a>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover btn-default" id="datatable">
                                    @foreach($data_siswa as $siswa)
                                        @endforeach
                                    <thead >
                                    <tr>
                                     <th>NAMA</th>
                                        <th>FALKUTAS</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>AGAMA</th>
                                        <th>ALAMAT</th>
                                        <th>TGL LAHIR</th>
                                        <th>NILAI RATA-RATA</th>
                                        <th>AKSI</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal import siswa -->
    <div class="modal fade" id="importSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'siswa.import', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    {!! Form::file('data_siswa') !!}
                </div>
                <div class="modal-footer">
                   <input type="submit" class="btn btn-sm btn-info" value="import">
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/siswa/create" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-grup {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                        <label for="exampleInputEmaill">Nama Depan</label>
                        <input name="nama_depan" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{old('nama_depan')}}">
                        @if($errors->has('nama_depan'))
                                <span class="help-block">{{$errors->first('nama_depan')}}</span>
                            @endif
                    </div>

                    <div class="form-grup {{$errors->has('nama_belakang') ? 'has-error' : ''}}">
                        <label for="exampleInputEmaill">Nama Belakang</label>
                        <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{old('nama_belakang')}}">
                        @if($errors->has('nama_belakang'))
                            <span class="help-block">{{$errors->first('nama_belakang')}}</span>
                        @endif
                    </div>

                    <div class="form-grup {{$errors->has('falkutas') ? 'has-error' : ''}}">
                        <label for="exampleInputEmaill">Falkutas</label>
                        <input name="falkutas" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Falkutas" value="{{old('falkutas')}}">
                        @if($errors->has('falkutas'))
                            <span class="help-block">{{$errors->first('falkutas')}}</span>
                        @endif
                    </div>

                    <div class="form-grup {{$errors->has('email') ? 'has-error' : ''}}">
                        <label for="exampleInputEmaill">Email</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Email" value="{{old('email')}}">
                        @if($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                    </div>

                    <div class="form-grup {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
                        <label for="exampleFormControlSelectl">Pilih Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelectl">
                            <option value="L"{{(old('jenis_kelamin') == 'L' ) ? 'selected' : ''}}>Laki-Laki</option>
                            <option value="P"{{(old('jenis_kelamin') == 'P' ) ? 'selected' : ''}}>Perempuan</option>
                        </select>
                        @if($errors->has('jenis_kelamin'))
                            <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
                        @endif
                    </div>

                    <div class="form-grup {{$errors->has('agama') ? 'has-error' : ''}}">
                        <label for="exampleInputEmaill">Agama</label>
                        <input name="agama" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Agama" value="{{old('agama')}}">
                        @if($errors->has('agama'))
                            <span class="help-block">{{$errors->first('agama')}}</span>
                        @endif
                    </div>

                    <div class="form-grup">
                        <label for="exampleFormControlTextareal">Alamat</label>
                        <textarea name="alamat" class="form-control" id="exampleFormControlTextareal" rows="3" >{{old('alamat')}}</textarea>
                    </div>

                    <div class="form-grup {{$errors->has('avatar') ? 'has-error' : ''}} ">
                        <label for="exampleFormControlTextareal">Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                        @if($errors->has('avatar'))
                            <span class="help-block">{{$errors->first('avatar')}}</span>
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
 @stop

@section('footer')
            <script>
                var editor;

                    $(document).ready(function() {
                        $('#datatable').DataTable( {
                            processing:true,
                            serverside:true,
                            ajax: "{{route('ajax.get.data.siswa')}}",
                            columns: [
                                { data: "nama_lengkap"},
                                { data: "falkutas" }    ,
                                { data: "jenis_kelamin" },
                                { data: "agama" },
                                { data: "alamat" },
                                { data: "tgl_lahir" },
                                { data: "rata2_nilai" },
                                { data: "aksi",orderable:false,searchable:false},
                            ]
                        } );

                } );

                $('.delete').click(function (){
                    var siswa_id = $(this).attr('siswa-id');

                    swal({
                        title: "Yakin anda?",
                        text: "Mau di hapus data Siswa dengan id "+siswa_id+" ?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            console.log(willDelete);
                            if (willDelete) {
                                window.location = "/siswa/"+siswa_id+"/delete";
                            }
                        });
                });
            </script>
   @stop

