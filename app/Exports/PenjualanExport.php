<?php

namespace App\Exports;

use App\Models\Faktur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PenjualanExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Faktur::with(['sales.toko', 'item'])
            ->select(
                'kode_sales', 
                'kode_toko', 
                'kode_item', 
                DB::raw('SUM(stok_terjual) as total_terjual'),
                DB::raw('SUM(total_bayar) as total_bayar')
            )
            ->groupBy('kode_sales', 'kode_toko', 'kode_item')
            ->get();
    }

    public function map($faktur): array
    {
        return [
            $faktur->sales->kode_sales,
            $faktur->sales->nama_sales,
            $faktur->toko->kode_toko,
            $faktur->toko->nama_toko,
            $faktur->item->kode_item,
            $faktur->item->nama_item,
            $faktur->total_terjual,
            $faktur->total_bayar,
        ];
    }

    public function headings(): array
    {
        return [
            'ID Sales',
            'Nama Sales',
            'ID Toko',
            'Nama Toko',
            'ID Item',
            'Nama Item',
            'Jumlah Terjual',
            'Nominal Terjual',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 10,
            'D' => 20,
            'E' => 10,
            'F' => 25,
            'G' => 15,
            'H' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Adding table title
        $sheet->setCellValue('A1', 'Laporan Penjualan'); // Set the title text
        $sheet->mergeCells('A1:H1'); // Merge cells for the title
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Adding table header
        $sheet->setCellValue('A2', 'ID Sales');
        $sheet->setCellValue('B2', 'Nama Sales');
        $sheet->setCellValue('C2', 'ID Toko');
        $sheet->setCellValue('D2', 'Nama Toko');
        $sheet->setCellValue('E2', 'ID Item');
        $sheet->setCellValue('F2', 'Nama Item');
        $sheet->setCellValue('G2', 'Jumlah Terjual');
        $sheet->setCellValue('H2', 'Nominal Terjual');
        $sheet->getStyle('A2:H2')->getFont()->setBold(true); // Set bold for the header

        // Adding table data    
        $sheet->getStyle('A2:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set horizontal center for the header
    }
}
