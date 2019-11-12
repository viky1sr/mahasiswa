@extends('layout/main');

@section('header')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    @stop
@section('kepo')
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-f luid">
                @if(session('sukses'))
                     <div class="alert alert-success" role="alert">
                        {{session('sukses')}}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <div class="panel panel-profile">
                    <div class="clearfix">
                        <!-- LEFT COLUMN -->
                        <div class="profile-left">
                            <!-- PROFILE HEADER -->
                            <div class="profile-header">
                                <div class="overlay"></div>
                                <div class="profile-main">
                                    <img src="{{$siswa->getAvatar()}}" width="130" class="img-circle" alt="avatar">
                                    <h3 class="name">{{$siswa->nama_lengkap()}}</h3>
                                    <span class="online-status status-available">Available</span>
                                </div>
                                <div class="profile-stat">
                                    <div class="row">
                                        <div class="col-md-4 stat-item">
                                            {{$siswa->makul->count()}} <span>Mata Pelajaran</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            {{$siswa->rataRataNilai()}}<span>Rata-Rata Nilai</span>
                                        </div>
                                        <div class="col-md-4 stat-item">{{$siswa->falkutas}}<span>Falkutas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE HEADER -->
                            <!-- PROFILE DETAIL -->
                            <div class="profile-detail">
                                <div class="profile-info">
                                    <h4 class="heading">Data diri</h4>
                                    <ul class="list-unstyled list-justify">
                                        <li>Jenis Kelamin <span>{{$siswa->jenis_kelamin}}</span></li>
                                        <li>Agama <span>{{$siswa->agama}}</span></li>
                                        <li>Alamat <span>{{$siswa->alamat}}</span></li>

                                    </ul>
                                </div>

                                <div class="text-center"><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning">Edit Profile</a></div>
                            </div>
                            <!-- END PROFILE DETAIL -->
                        </div>
                        <!-- END LEFT COLUMN -->
                        <!-- RIGHT COLUMN -->
                        <div class="profile-right">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Tambah Nilai
                            </button>

                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Mata Pelajaran</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>SEMESTER</th>
                                            <th>NILAI</th>
                                            <th>GURU</th>
                                            <th>AKSI</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($siswa->makul as $makul)
                                           <tr>
                                               <td>{{$makul->kode}}</td>
                                               <td>{{$makul->nama}}</td>
                                               <td>{{$makul->semester}}</td>
{{--                                               <td><a href="#" class="semester" data-type="text" data-pk="{{$makul->id}}" data-url="/api/siswa{{$siswa->id}}/editsemester" data-title="Enter username">{{$makul->semester}}</a></td>--}}
                                               <td><a href="#" class="nilai" data-type="text" data-pk="{{$makul->id}}" data-url="/api/siswa{{$siswa->id}}/editnilai" data-title="Enter nilai">{{$makul->pivot->nilai}}</a></td>
                                               <td><a href="/guru/{{$makul->guru_id}}/profile">{{$makul->guru->nama}}</a></td>
                                               <td><a href="#" class="btn btn-danger btn-sm deletenilai"  siswa-id="{{$siswa->id}}">Delete</a>
                                               </td>
                                           </tr>
                                       @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel">
                                <div id="chartNilai"></div>
                            </div>
                        </div>
                        <!-- END RIGHT COLUMN -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="/siswa/{{$siswa->id}}/addnilai" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="makul">Mata Pelajaran</label>
                            <select class="form-control" id="makul" name="makul">
                                @foreach($makulus as $kepo)
                                <option value="{{$kepo->id}}">{{$kepo->nama}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-grup {{$errors->has('nilai') ? 'has-error' : ''}}">
                            <label for="exampleInputEmaill">Nilai</label>
                            <input name="nilai" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="nilai" value="{{old('nilai')}}">
                            @if($errors->has('nilai'))
                                <span class="help-block">{{$errors->first('nilai')}}</span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @stop

@section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        $('.deletenilai').click(function (){
            var siswa_id = $(this).attr('siswa-id');

            swal({
                title: "Yakin anda?",
                text: "Mau di hapus posts dengan id "+siswa_id+" ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    console.log(willDelete);
                    if (willDelete) {
                        window.location = "/siswa/"+siswa_id+"/deletenilai";
                    }
                });

        });
    </script>

    <script>
        Highcharts.chart('chartNilai', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan Nilai Siswa'
            },
            xAxis: {
                categories: {!!json_encode($categories)!!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nilai'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Nilai',
                data: {!! json_encode($data12) !!},

            }]
        });
        $(document).ready(function() {
            $('.nilai').editable();
            $('.semester').editable();
        });
    </script>
    @stop
