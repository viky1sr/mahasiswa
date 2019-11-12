@extends('layout/frontend');

@section('kepo')
    <section class="banner-area relative about-banner" style="background: url('{{config('sekolah.image_benner_url')}}');" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Pendaftaran
                    </h1>
                    <p class="text-white link-nav"><a href="index.html">Home </a><span class="lnr lnr-arrow-right"></span>  <a href="about.html"> Pendaftaran</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="search-course-area relative" style="background: unset;" >
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5 col-md-6 search-course-left">
                    <h1>
                        Pendaftaran Online <br>
                        Bergabung bersama kami !
                    </h1>
                    <p>
                        inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach.
                    </p>
                </div>
                <div class="col-lg-5 col-md-6 search-course-right section-gap">
                        {!! Form::open(['url' => '/postregister','class' => 'form-wrap']) !!}
                        <h4 class="pb-20 text-center mb-30">Isi data dirimu</h4>
                        {!! Form::text('nama_depan', '',['class' => 'form-control', 'placeholder' => 'Nama Depan']) !!}
                        {!! Form::text('nama_belakang', '',['class' => 'form-control', 'placeholder' => 'Nama Belakang']) !!}
                        {!! Form::text('falkutas', '',['class' => 'form-control', 'placeholder' => 'Falkutas']) !!}
                    <div class="form-select" id="service-select">
                        {!! Form::select('agama', ['' => 'Pilih Agama','Islam' => 'Islam', 'Kristen' => 'Kristen','Hindu' => 'Hindu', 'Katolik' => 'Katolik', 'Budha' => 'Budha'  ],' '); !!}
                    </div>
                        {!! Form::date('tgl_lahir', '',['class' => 'form-control', 'placeholder' => 'Tgl Lahir']) !!}
                        {!! Form::textarea('alamat', '',['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                      <div class="form-select" id="service-select">
                        {!! Form::select('jenis_kelamin', ['' => 'Pilih Jenis Kelamin','L' => 'Laki-Laki', 'P' => 'Perempuan'],' '); !!}
                      </div>

                    <div class="form-grup {{$errors->has('email') ? 'has-error' : ''}}">
                       {!! Form::email('email', '',['class' => 'form-control', 'placeholder' => 'Email', 'value'=>'{{old(email)}}' ])!!}
                        @if($errors->has('email'))
                            <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                    </div>

                       {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                        <input type="submit" class="primary-btn text-uppercase register"  value="SUBMIT" style="text-align: center;">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')
    <script>
        swal("Good Job","You click the Button!","sukses")
    </script>
@stop
