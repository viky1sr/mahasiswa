@extends('layout/main');

@section('kepo')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="font-weight-bold">Data Dosen</h3>
                                <div class="right">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover btn-default" id="datatable">
                                    <thead >
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NO TLPN</th>
                                        <th>ALAMAT</th>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru!</h5>
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

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
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
                ajax: "{{route('ajax.get.data.guru')}}",
                columns: [
                    { data: "nama" },
                    { data: "tlpn" },
                    { data: "alamat" },
                    { data: "aksi" },
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

