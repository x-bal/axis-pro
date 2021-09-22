<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class InvoiceExport implements FromCollection, ShouldAutoSize, WithHeadings,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $attr;
    public function __construct($attr)
    {
        $this->attr = $attr;        
    }
    public function collection()
    {
        $data = Invoice::whereBetween('date_invoice', [$this->attr['from'], $this->attr['to']])->get();
        return $data;
    }
    
    public function styles(Worksheet $sheet)
    {
        $string = 'A1:K1';
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
        $sheet->getStyle($string)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }
    
    public function headings(): array
    {
        return [
            [
                'id',
                'case_list_id',
                'no_invoice',
                'member_id',
                'due_date',
                'date_invoice',
                'grand_total',
                'status_paid',
                'is_active',
                'created_at',
                'updated_at'
            ]
        ];
    }
}
