<?php

namespace App\Exports;

use App\Models\PowerPlant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromView
{
    private $power_plant;
    private $type;
    private $data;
    
    public function __construct($power_plant,$type, $data)
    {
        $this->power_plant = $power_plant;
        $this->type = $type;
        $this->data = $data;
    }
    
    public function view(): View
    {
        switch ($this->type) {
            case "BBM Pemakaian":
                $report_template = "exports.pltd-reports.bbm-pemakaian";
                break;
            case "BBM Stok":
                $report_template = "exports.pltd-reports.bbm-stok";
                break;
            case "Beban":
                $report_template = "exports.pltd-reports.beban";
                break;
            case "Fast Moving":
                $report_template = "exports.pltd-reports.fast-moving";
                break;
            case "Gangguan":
                $report_template = "exports.pltd-reports.gangguan";
                break;
            case "HAR Realisasi":
                $report_template = "exports.pltd-reports.har-realisasi";
                break;
            case "HAR Rencana":
                $report_template = "exports.pltd-reports.har-rencana";
                break;
            case "KWH":
                $report_template = "exports.pltd-reports.kwh";
                break;
            case "Pelumas":
                $report_template = "exports.pltd-reports.pelumas";
                break;
            case "Utama":
                $report_template = "exports.plts-reports.utama";
                break;
            default:
                break;
        }
        
        $engine_quantity = PowerPlant::find($this->power_plant['id'])->engine_quantity ?? '';
        
        return view($report_template , [
            'data' => $this->data,
            'power_plant' => $this->power_plant,
            'type' => strtoupper($this->type),
            'engine_quantity' => $engine_quantity,
            'style' => [
                'main_info'=> 'font-weight: bold; font-size: 16px;',
                'secondary_info' => '',
                'table' => 'border-collapse: collapse;',
                'header' => 'border: 1px solid #000000; width: 150px; background-color: #F4F4F5; font-weight: bold; text-align: center;',
                'body' => 'border: 1px solid #000000; width: 150px; text-align: center;'
            ]
        ]);
    }
}