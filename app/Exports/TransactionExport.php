<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Http\Resources\TransactionExports;

class TransactionExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function headings(): array
    {
        return [
            "Nama Driver",
            "Kendaraan",
            "Mulai Booking",
            "Tanggal Ambil",
            "Tanggal Kembali",
            "Sudah Diambil",
            "Sudah Dikembalikan",
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            "1" => [
                'row_height' => 30
            ],
            "A1:G1" => [
                "font" => [
                    "bold" => true,
                    "size" => 14
                ],
                "fill" => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        "rgb" => "32a846"
                    ]
                ]
            ]
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transactions = Transaction::whereMonth('booking_start', date('m'))->get();
        return TransactionExports::collection($transactions);
    }
}
