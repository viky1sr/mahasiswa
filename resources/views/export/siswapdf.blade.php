<table class="table">
    <thead>
        <tr>
            <th>NAMA LENGKAP</th>
            <th>JENIS KELAMIN</th>
            <th>AGAMA</th>
            <th>NILAI RATA-RATA</th>
            <th>ALAMAT</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $s)
        <tr>
            <td>{{$s->nama_lengkap()}}</td>
            <td>{{$s->jenis_kelamin}}</td>
            <td>{{$s->agama}}</td>
            <td>{{$s->rataRataNilai()}}</td>
            <td>{{$s->alamat}}</td>
        </tr>
          @endforeach
    </tbody>
</table>
