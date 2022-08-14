<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class barangExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::all();
    }
    public function map($invoice): array
    {
        return [
            $invoice->kode,
            $invoice->nama,
            $invoice->merek,
            $invoice->jenis,
            $invoice->satuan,
            $invoice->jumlah,
            $invoice->harga,
        ];
    }
    public function headings(): array
    {
        return ['Kode','Nama','Merek','Jenis','Satuan','Jumlah','Harga'];
    }
}
