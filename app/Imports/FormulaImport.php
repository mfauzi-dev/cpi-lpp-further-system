<?php

namespace App\Imports;

use App\Models\BahanBaku;
use App\Models\ProductFormula;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FormulaImport implements ToCollection, WithHeadingRow
{
    public function __construct(
        protected int $productId,
        protected string $formulaName
    ) {
    }

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
            'total_kg',
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
            $totalKg = $row['total_kg'] ?? null;

            if (empty($kode) && empty($nama)) {
                continue;
            }

            if ($totalKg === '' || $totalKg === null) {
                continue;
            }

            $bahanBaku = null;

            if (!empty($kode)) {
                $bahanBaku = BahanBaku::where('kode', $kode)->first();
            }

            if (!$bahanBaku && !empty($nama)) {
                $bahanBaku = BahanBaku::where('name', $nama)->first();
            }

            if (!$bahanBaku) {
                throw new \Exception(
                    "Bahan baku dengan kode '{$kode}' / nama '{$nama}' tidak ditemukan di master Bahan Baku."
                );
            }

            ProductFormula::updateOrCreate(
                [
                    'product_id' => $this->productId,
                    'bahan_baku_id' => $bahanBaku->id,
                    'name' => $this->formulaName,
                ],
                [
                    'total_kg' => (float) $totalKg,
                ]
            );
        }
    }
}