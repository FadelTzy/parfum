@extends('pdf.layout')

@section('content')
<h4 class="" style="text-align: center;">LAPORAN JUMLAH SKS YANG TELAH DICAPAI DAN DIPROGRAM MAHASISWA</h4>


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
            <th class="p">Semester</th>
            <th class="p">{{$smsaktif}}</th>
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
            <th class="text-center" style="width: 12%; text-align:center">SKS DIPROGRAM</th>
            <th class="text-center" style="width: 12%; text-align:center">SKS DILULUSI</th>
            <th class="text-center" style="width: 30%; text-align:center">SKSK BELUM DILULUSI</th>
            <th class="text-center" style="width: 30%; text-align:center">TOTAL SKS TELAH DICAPAI</th>
            <th class="text-center" style="width: 10%; text-align:center">IPS</th>
            <th class="text-center" style="width: 10%; text-align:center">IPK</th>

        </tr>

        @foreach($sks->getData()->data as $t)
        <tr>
            <td style=" text-align:center">{{$t->semester}}</td>
            <td style=" text-align:center">{{$t->sksprogram}}</td>
            <td style=" text-align:center">{{$t->skslulus}}</td>
            <td style=" text-align:center">{{$t->sksbelum}}</td>
            <td style=" text-align:center">{{$t->total}}</td>
            <td style=" text-align:center">{{$t->ips}}</td>
            <td style=" text-align:center">{{$t->ipk}}</td>


        </tr>
        @endforeach

    </tbody>
</table>
@endsection