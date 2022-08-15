<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class barangImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $checking = Barang::where('kode', $row['kode'])->first();
            if ($checking) {
              $checking->merek= $row['merek'];
              $checking->nama= $row['nama'];
              $checking->jenis= $row['jenis'];
              $checking->satuan= $row['satuan'];
              $checking->jumlah= $row['jumlah'];
              $checking->harga= $row['harga'];
              $checking->save();
            } else {
                Barang::create([
                    'kode' => $row['kode'] ?? null,
                    'merek' => $row['merek'],
                    'nama' => $row['nama'],
                    'jenis' => $row['jenis'],
                    'satuan' => $row['satuan'],
                    'jumlah' => $row['jumlah'],
                    'harga' => $row['harga'],
                ]);
            }
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
