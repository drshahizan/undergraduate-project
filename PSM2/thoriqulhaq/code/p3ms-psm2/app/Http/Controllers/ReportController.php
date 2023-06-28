<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\PowerPlant;
use App\Models\Recapitulation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    private function getdataItems ($report_type) {
        $data = [];
        switch ($report_type) {
            case 'BBM Pemakaian':
                $data = Recapitulation::getBBMPemakaian();
                break;
            case 'BBM Stok':
                $data = Recapitulation::getBBMStok();
                break;
            case 'Beban':
                $data = Recapitulation::getBeban();
                break;
            case 'Fast Moving':
                $data = Recapitulation::getFastMoving();
                break;
            case 'Gangguan':
                $data = Recapitulation::getGangguan();
                break;
            case 'HAR Realisasi':
                $data = Recapitulation::getHARRealisasi();
                break;
            case 'HAR Rencana':
                $data = Recapitulation::getHARRencana();
                break;
            case 'KWH':
                $data = Recapitulation::getKWH();
                break;
            case 'Pelumas':
                $data = Recapitulation::getPelumas();
                break;
            case 'Utama':
                $data = Recapitulation::getUtama();
                break;
            default:
                $data = [];
                break;
        }
        
        return $data;
    }
    
    public function viewReport ($filter = [], $preview = []) {
        $power_plants = PowerPlant::all();
        
        $list_power_plant = [];
        
        foreach ($power_plants as $power_plant) {
            array_push($list_power_plant, [
                'name' => $power_plant->name,
                'id' => $power_plant->id,
                'type' => $power_plant->power_plant_type
            ]);
        }
        
        return Inertia::render('Staff/UnduhLaporan', [
            'listPowerPlant' => $list_power_plant,
            'filter' => $filter,
            'preview' => $preview
        ]);
    }
    
    public function generateReport (Request $request) {
        $filter = [
            'power_plant_type' => $request->power_plant_type,
            'power_plant_id' => $request->power_plant_id,
            'report_type' => $request->report_type,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end
        ];
        $preview = [
            'data' => $this->getdataItems($request->report_type['name']),
        ];
        
        return $this->viewReport($filter, $preview);
    }
    
    public function downloadReport (Request $request) {
        $report_name = 'Laporan_'.$request->report_type['name'].' '.$request->power_plant_id['name'].'('.$request->date_start.'-'.$request->date_end.')'.'.xlsx';
        $data = $this->getdataItems($request->report_type['name']);
        // dd($data); 
        return Excel::download(new ReportExport($request->power_plant_id, $request->report_type['name'], $data), $report_name);
    }
}
