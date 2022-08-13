<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nota | Transaksi</title>
    <style type="text/css">
        table {
            max-width: 100%;
            max-height: 100%;
        }

        body {
            padding: 5px;
            position: relative;
            width: 100%;
            height: 100%;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table .kop:before {
            content: ': ';
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        table #caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table.border {
            width: 100%;
            /* border-collapse: collapse */
        }

        table.borderdua {
            width: 20%;
            /* border-collapse: collapse */
        }

        table.border tbody th,
        table.border tbody td {
            border: thin solid #000;
            padding: 2px
        }

        table.borderdua tbody th,
        table.borderdua tbody td {
            border: thin solid #000;
            padding: 2px
        }

        table.bordertiga tbody th,
        table.bordertiga tbody td {
            border: thin solid #000;
            padding: 2px
        }

        .ttd td,
        .ttd th {
            padding-bottom: 4em;
        }
    </style>
</head>

<body>
    <div id="printable" class="container">
        <div class="row">
            <div class="col">
                <table border="0" cellpadding="0" cellspacing="0" width="10%" style="float:left;">
                    <tbody>
                        <tr>
                            {{-- <img src="{{ asset('image/logo.png') }}" width="70" height="70"> --}}
                            <img src="{{ url('image/logoapp/' . $logo) }}" alt="" height="70">
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table border="0" cellpadding="0" cellspacing="0" width="30%" class="bordertiga"
                    style="float:left; padding-right : 1%">
                    {{-- <thead>
                    <tr>
                        <td>koko</td>
                    </tr>
                </thead> --}}
                    <tbody>
                        <tr>
                            <td class="left">{{ $nama_app }}</td>
                        </tr>
                        <tr>
                            <td class="left">{{ $alamat }} No. 62D Telp. {{ $notelp }}-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table border="0" cellpadding="0" cellspacing="0" width="30%" class="bordertiga"
                    style="float:left; padding-right : 1%">
                    {{-- <thead>
                    <tr>
                        <td>koko</td>
                    </tr>
                </thead> --}}
                    <tbody>
                        <tr>
                            <td>Ket</td>
                        </tr>
                        <tr>
                            <td>Nota Putih bukti Pembayaran & Peangihan yang SAH KURS : 14750</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table border="0" cellpadding="0" cellspacing="0" width="31%" class="bordertiga"
                    style="float:left; padding-right : 1%">
                    {{-- <thead>
                        <tr>
                            <td ></td>
                        </tr>
                    </thead> --}}
                    <tbody>
                        <tr>
                            <th colspan="2">FAKTUR PENJUALAN</th>
                        </tr>
                        <tr>
                            <th>Tanggal Faktur</th>
                            <th>No. Faktur</th>
                        </tr>
                        <tr>
                            <td>01 JUN 2022
                            </td>
                            <td>JL012022124</td>
                        </tr>
                        <tr>
                            <th>Jenis Transaksi</th>
                            <th>Term</th>
                        </tr>
                        <tr>
                            <td>TITIP JUAL</td>
                            <td>
                                7 Hari <br>
                                Batas : 08 JUNI 2022
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <table border="0" cellpadding="0" cellspacing="0" width="69%" class="bordertiga">
            <thead>
                <td style="height: 9%"></td>
            </thead>
            <tbody>
                <tr>
                    <td class="left">
                        Pelanggan :
                    </td>
                    <td class="left">
                        Keterangan : Transfer Ke
                    </td>
                </tr>
                <tr>
                    <td>
                        ANNA PARFUM - C0546
                        <br>
                        Jl. Pelita
                    </td>
                    <td>
                        BCA {{ $atm }} a/n SALWA
                    </td>
                </tr>
            </tbody>
        </table>


        <table border="0" cellpadding="0" cellspacing="0" class="border">
            <thead>
                <td></td>
            </thead>
            <tbody>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kode Barang</th>
                    <th rowspan="2">Nama Barang</th>
                    <th rowspan="2">Jml</th>
                    <th rowspan="2">Satuan</th>
                    <th rowspan="2" style="width: 1%">Disc.</th>
                    <th colspan="2">Dollar</th>
                    <th colspan="2">Rupiah</th>
                </tr>
                <tr>
                    <td>Harga @</td>
                    <td>Total</td>
                    <td>Harga @</td>
                    <td>Total Harga</td>
                </tr>
                @foreach ($barang as $b)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $b->kodebarang }}</td>
                        <td>{{ $b->namabarang }}</td>
                        <td class="right">{{ $b->jumlah }}</td>
                        <td class="right">{{ $b->satuan }}</td>
                        <td></td>
                        <td class="right">0</td>
                        <td class="right">0</td>
                        <td class="right">{{ $b->harga }}</td>
                        <td class="right">{{ $b->harga * $b->jumlah }}</td>
                    </tr>
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="ttd">
                    <th colspan="2">Customer</th>
                    <th colspan="2">Diterima</th>
                    <th colspan="2">Mengetahui</th>
                </tr>
                <tr>
                    <td colspan="2">Cv Akarmas Curva</td>
                    <td colspan="2">Saseh Sunifah</td>
                    <td colspan="2">Bambang Widiyoko</td>
                </tr>
            </tfoot> --}}
        </table>



        <div style="float: left;margin-right:40%;">
            <table>
                <tbody>
                    <tr>
                        <td style="width: 50%">Disiapkan Oleh:</td>
                        <td>Diterima Oleh:</td>
                    </tr>
                    <tr style="height: 0.5%">
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td class="left">Tgl:</td>
                        <td class="left">Tgl:</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">Terbilang Rp.</td>
                        <td class="left">: Seratus Sembilan puluh ribu dua ratus tujuh puluh tujuh rupiah</td>
                    </tr>
                    <tr>
                        <td class="left">Terbilang USD ($)</td>
                        <td class="left">: Tiga Belas Dollar</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="float: right; display: inline-block; width : 42%">
            <table border="0" cellpadding="0" cellspacing="0" class="border">
                <tbody>
                    <tr>
                        <td style="width: 25%" class="left">Subtotal</td>
                        <td style="width: 24%" class="right">0</td>
                        <td class="right">{{ $transaksi->totalharga }}</td>
                    </tr>
                    <tr>
                        <td class="left">PPn</td>
                        <td class="right">0</td>
                        <td class="right">0,00</td>
                    </tr>
                    <tr>
                        <td class="left">Diskon</td>
                        <td class="right">0</td>
                        <td class="right">0,00</td>
                    </tr>
                    <tr>
                        <td class="left">Ongkos Kirim</td>
                        <td class="right">0</td>
                        <td class="right">0,00</td>
                    </tr>
                    <tr>
                        <td class="left">Dibayar Muka</td>
                        <td class="right">0</td>
                        <td class="right">0,00</td>
                    </tr>
                    <tr>
                        <td class="left">Total Nota</td>
                        <td class="right">0</td>
                        <td class="right">{{ $transaksi->totalharga }}</td>
                    </tr>
                    <tr>
                        <td class="left">Pembayaran</td>
                        <td class="right">0</td>
                        <td class="right">0</td>
                    </tr>
                    <tr>
                        <td class="left">Piutang</td>
                        <td class="right">0</td>
                        <td class="right">{{ $transaksi->totalharga }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Sisa Piutang s/d Nota ini : Rp. 3.236.833</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
