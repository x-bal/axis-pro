<?php

namespace App\Exports;

use App\Models\CaseList;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class CaseListExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
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
        $collection = new Collection();
        $status = $this->attr['status'];
        if ($this->attr['status'] == "All") {
            $case =  CaseList::whereBetween('instruction_date', [$this->attr['from'], $this->attr['to']])->get();
            return $case;
        }
        $case = CaseList::whereBetween('instruction_date', [$this->attr['from'], $this->attr['to']])->where('file_status_id', $status)->get();
        return $case;
    }
    public function styles(Worksheet $sheet)
    {
        $string = 'A1:AV1';
        $sheet->getStyle('A1:AV1')->getFont()->setBold(true);
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
                'file_no',
                'insurance_id',
                'adjuster_id',
                'broker_id',
                'incident_id',
                'policy_id',
                'category',
                'insured',
                'risk_location',
                'currency',
                'leader',
                'begin',
                'end',
                'dol',
                'no_leader_policy',
                'leader_claim_no',
                'instruction_date',
                'survey_date',
                'now_update',
                'ia_date',
                'ia_amount',
                'ia_status',
                'pr_date',
                'pr_amount',
                'pr_status',
                'ir_status',
                'ir_st_date',
                'ir_st_amount',
                'ir_st_status',
                'ir_nd_date',
                'ir_nd_amount',
                'ir_nd_status',
                'pa_date',
                'pa_amount',
                'pa_status',
                'fr_date',
                'fr_amount',
                'fr_status',
                'claim_amount',
                'fee_idr',
                'fee_usd',
                'wip_idr',
                'wip_usd',
                'remark',
                'file_status_id',
                'created_at',
                'updated_at',
            ]
        ];
    }
}
