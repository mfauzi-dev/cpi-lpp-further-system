<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
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
            'kode_produk',
            'nama_produk',
            'gramasi',
            'pack_per_box',
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
            $kode = trim($row['kode_produk'] ?? '');
            $nama = trim($row['nama_produk'] ?? '');
            $gramasi = $row['gramasi'] ?? null;
            $packPerBox = $row['pack_per_box'] ?? null;

            if (empty($kode) && empty($nama)) {
                continue;
            }

            if (empty($nama)) {
                throw new \Exception(
                    "nama_produk tidak boleh kosong."
                );
            }

            if ($gramasi === '' || $gramasi === null) {
                $gramasi = null;
            } else {
                $gramasi = (float) $gramasi;
            }

            if ($packPerBox === '' || $packPerBox === null) {
                $packPerBox = null;
            } else {
                $packPerBox = (int) $packPerBox;
            }

            if (!empty($kode)) {
                Product::updateOrCreate(
                    [
                        'kode' => $kode,
                    ],
                    [
                        'nama' => $nama,
                        'gramasi' => $gramasi,
                        'pack_per_box' => $packPerBox,
                    ]
                );
            } else {
                $product = Product::where('nama', $nama)->first();

                if ($product) {
                    $product->update([
                        'gramasi' => $gramasi,
                        'pack_per_box' => $packPerBox,
                    ]);
                } else {
                    Product::create([
                        'kode' => null,
                        'nama' => $nama,
                        'gramasi' => $gramasi,
                        'pack_per_box' => $packPerBox,
                    ]);
                }
            }
        }
    }
}