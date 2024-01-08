<?php

namespace App\Exports;

use App\Models\Building;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SubscriberBuildingExport implements FromCollection, WithHeadings, WithStyles,WithMapping ,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Building::where('added_by',Auth::user()->id)->latest()->get();
    }

    public function map($building): array
    {
        return [
            $building->building_title,
            '',
            $building->contract_price,
            '',
            $building->contract_date,
            '',
            $building->building_location,
            '',
        ];
    }
    public function headings(): array
    {
        return [
            'اسم العقار',
            '',
            'قيمه العقد',
            '',
            'تاريخ التحصيل',
            '',
            'العنوان',
            '',
        ];
    }


    public function styles( $sheet)
    {

        $sheet->setRightToLeft(true);

        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => [
                    'outline' => ['borderStyle' => Border::BORDER_THIN],
                ],
                'fill' => [

                    'startColor' => ['argb' => 'FFA0A0A0'],
                    'endColor' => ['argb' => 'FFFFFFFF'],
                ],
            ],
        ];
    }

}
