@extends('layout.main');

@section('kepo')

    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Ranking 5 Besar</h3>
                            </div>
                                <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>RANKING</th>
                                        <th>NAMA</th>
                                        <th>NILAI</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $ranking = 1;
                                    @endphp
                                        @foreach(ranking5Besar() as $s)
                                        <tr>
                                            <td>{{$ranking++}}</td>
                                            <td>{{$s->nama_lengkap()}}</td>
                                            <td>{{$s->rataRataNilai}}</td>
                                        </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="metric">
                            <span class="award-icon"><i class="fa fa-user"></i></span>
                            <p>
                                <span class="number">{{totalSiswa()}}</span>
                                <span class="title">Siswa</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="metric">
                            <span class="award-icon"><i class="fa fa-user"></i></span>
                            <p>
                                <span class="number">{{Guru()}}</span>
                                <span class="title">Guru</span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop
