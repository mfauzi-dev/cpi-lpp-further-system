<?php

namespace App\Imports;

use App\Models\BahanBaku;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BahanBakuImport implements ToCollection, WithHeadingRow
{
    public function headingRow(): int
    {
        return 3;
    }

    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) {
            throw new \Exception('File Excel kosong.');
        }

        $requiredHeaders = [
            'kode_bahan_baku',
            'nama_bahan_baku',
        ];

        $headers = array_keys($rows->first()->toArray());

        foreach ($requiredHeaders as $header) {
            if (!in_array($header, $headers)) {
                throw new \Exception(
                    "Format Excel tidak sesuai. Kolom '{$header}' tidak ditemukan."
                );
            }
        }

        foreach ($rows as $row) {
            $kode = trim($row['kode_bahan_baku'] ?? '');
            $nama = trim($row['nama_bahan_baku'] ?? '');

            if (empty($kode) && empty($nama)) {
                continue;
            }

            if (empty($nama)) {
                throw new \Exception(
                    "nama_bahan_baku tidak boleh kosong."
                );
            }

            if (!empty($kode)) {
                BahanBaku::updateOrCreate(
                    [
                        'kode' => $kode,
                    ],
                    [
                        'name' => $nama,
                    ]
                );
            } else {
                $bahanBaku = BahanBaku::where('name', $nama)->first();

                if ($bahanBaku) {
                    $bahanBaku->update([
                        'name' => $nama,
                    ]);
                } else {
                    BahanBaku::create([
                        'kode' => null,
                        'name' => $nama,
                    ]);
                }
            }
        }
    }
}