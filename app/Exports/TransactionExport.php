<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use \Maatwebsite\Excel\Sheet;

class TransactionExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents,WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    private $collection;

    public function startCell(): string
    {
        return 'A2';
    }

    public function __construct($arrays)
    {
        $output = [];
        foreach ($arrays as $array) {
            $output[] = $array;
        }
        $this->collection = collect($output);
    }

    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        return [
            'Transaction_Number',
            'Agent_Ref',
            'Sent',
            'Rate',
            'Received',
            'Status',
            'Sender',
            'MembershipNumber',
            'Dob',
            'PhoneNumber',
            'ResidentialAddress',
            'Subrub',
            'State',
            'Postcode',
            'Occupation',
            'Receiver',
            'ReceiverResidentialAdd',
            'ReceiverProvience',
            'ReceiverDistrict',
            'ReceiverPostcode',
            'BankName',
            'AccountNumber',
            'Branch',
            'ContactNumber'
        ];
    }

    public function registerEvents(): array
    {
         return [
            AfterSheet::class    => function(AfterSheet $event) {
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', "Transaction Details");

                $sheet->mergeCells('G1:O1');
                $sheet->setCellValue('G1', "Sender Details");

                $sheet->mergeCells('P1:X1');
                $sheet->setCellValue('P1', "Receiver Details");
                
                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                
                $cellRange = 'A1:X1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);

                $event->sheet->styleCells(
                    'A1:X1',
                    [
                        // //Set border Style
                        // 'borders' => [ 
                        //     'outline' => [
                        //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        //         'color' => ['argb' => 'EB2B02'],
                        //     ],

                        // ],

                        //Set font style
                        'font' => [
                            'name'      =>  'Calibri',
                            'size'      =>  15,
                            'bold'      =>  false,
                            'color' => ['argb' => 'EB2B02'],
                        ],

                        //Set background style
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => '7EF952',
                             ]           
                        ],

                    ]
                );
                $event->sheet->styleCells(
                    'A2:X2',
                    [
                        // //Set border Style
                        // 'borders' => [ 
                        //     'outline' => [
                        //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        //         'color' => ['argb' => 'EB2B02'],
                        //     ],

                        // ],

                        //Set font style
                        'font' => [
                            'name'      =>  'Calibri',
                            'size'      =>  15,
                            'bold'      =>  false,
                            'color' => ['argb' => 'EB2B02'],
                        ],

                        //Set background style
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => 'F9D752',
                             ]           
                        ],

                    ]
                );
            },
        ];
    }
}
