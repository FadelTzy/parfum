@extends('pdf.layout')

@section('content')
<h4 class="" style="text-align: center;">KARTU KONSULTASI BIMBINGAN DOSEN PENASEHAT AKADEMIK</h4>


<table class="table p table-bordered table-hover table-striped">

    <tbody>
        <tr class="">
            <th style="width: 20%;" class="p">Nama</th>
            <th class="p">{{$mhs->nama}}</th>
        </tr>
        <tr class="">
            <th class="p">NIM</th>
            <th class="p">{{$mhs->nim}}</th>
        </tr>
        <tr class="">
            <th class="p">Jurusan / Prodi</th>
            <th class="p">Jurusan Teknik Informatika & Komputer / {{$mhs->prodi}}</th>
        </tr>
        <tr class="">
            <th class="p">Fakultas / Universitas</th>
            <th class="p"> Teknik / Universitas Negeri Makassar</th>
        </tr>
    </tbody>
</table>
<br>
<table class="p">
    <tbody>
        <tr class="">
            <th class="text-center" style="width:5%; text-align:center">SEMESTER</th>
            <th class="text-center" style="width: 12%; text-align:center">TANGGAL</th>
            <th class="text-center" style="width: 12%; text-align:center">TOPIK</th>
            <th class="text-center" style="width: 30%; text-align:center">MASALAH YANG DIKONSULTASIKAN</th>
            <th class="text-center" style="width: 30%; text-align:center">BIMBINGAN / SARAN YANG DIBERIKAN</th>
            <th class="text-center" style="width: 10%; text-align:center">TANDA TANGAN PA</th>
        </tr>

        @foreach($konsul->getData()->data as $t)
        <tr>
            <td style=" text-align:center">{{$t->semester}}</td>
            <td>{{$t->created_at}}</td>
            <td>{{$t->topik}}</td>
            <td>{{$t->masalah}}</td>
            <td>{{$t->saran ?? '-'}}</td>
            <td></td>

        </tr>
        @endforeach

    </tbody>
</table>
@endsection