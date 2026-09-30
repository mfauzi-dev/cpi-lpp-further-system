<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\ProcessType;
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
            'nama_produk_grup',
            'nama_process_type',
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
            $kodeProduct = trim($row['kode_produk'] ?? '');
            $nama = trim($row['nama_produk'] ?? '');
            $gramasi = $row['gramasi'] ?? null;
            $packPerBox = $row['pack_per_box'] ?? null;
            $groupName = trim($row['nama_produk_grup'] ?? '');
            $processTypeName = trim($row['nama_process_type'] ?? '');

            if (empty($kodeProduct) && empty($nama)) {
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

            $productGroup = null;

            if (!empty($groupName)) {
                $productGroup = ProductGroup::where('name', $groupName)->first();
            }

            $processType = null;

            if (!empty($processTypeName)) {
                $processType = ProcessType::where('name', $processTypeName)->first();
            }

            if (!empty($kodeProduct)) {
                Product::updateOrCreate(
                    [
                        'kode_product' => $kodeProduct,
                    ],
                    [
                        'nama' => $nama,
                        'gramasi' => $gramasi,
                        'pack_per_box' => $packPerBox,
                        'product_group_id' => $productGroup?->id,
                        'process_type_id' => $processType?->id,
                    ]
                );
            } else {
                $product = Product::where('nama', $nama)->first();

                if ($product) {
                    $product->update([
                        'gramasi' => $gramasi,
                        'pack_per_box' => $packPerBox,
                        'product_group_id' => $productGroup?->id,
                        'process_type_id' => $processType?->id,
                    ]);
                } else {
                    Product::create([
                        'kode_product' => null,
                        'nama' => $nama,
                        'gramasi' => $gramasi,
                        'pack_per_box' => $packPerBox,
                        'product_group_id' => $productGroup?->id,
                        'process_type_id' => $processType?->id,
                    ]);
                }
            }
        }
    }
}