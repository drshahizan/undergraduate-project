<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recapitulation\BBMPemakaianRequest;
use App\Http\Requests\Recapitulation\BBMStokRequest;
use App\Http\Requests\Recapitulation\BebanRequest;
use App\Http\Requests\Recapitulation\FastMovingRequest;
use App\Http\Requests\Recapitulation\GangguanRequest;
use App\Http\Requests\Recapitulation\HARRealisasiRequest;
use App\Http\Requests\Recapitulation\HARRencanaRequest;
use App\Http\Requests\Recapitulation\KWHRequest;
use App\Http\Requests\Recapitulation\PelumasRequest;
use App\Http\Requests\Recapitulation\UtamaRequest;
use App\Models\FastMoving;
use App\Models\Fuel;
use App\Models\FuelUsage;
use App\Models\HAR;
use App\Models\KWH;
use App\Models\Load;
use App\Models\Log;
use App\Models\Lubricant;
use App\Models\LubricantUsage;
use App\Models\Maintenance;
use App\Models\Material;
use App\Models\MaterialExpense;
use App\Models\PowerPlant;
use App\Models\Recapitulation;
use App\Models\SolarPanel;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class RecapitulationController extends Controller
{
    public function materialInfo() {
        $power_plant_id = Staff::where('user_id', '=', auth()->user()->id)->first()->power_plant_id;
        $list_material = Material::where('power_plant_id', '=', $power_plant_id)->get();
        $available_material = 0;
        $unavailable_material = 0;
        
        foreach ($list_material as $material) {
            if ($material->quantity != 0) {
                $available_material++;
            } else {
                $unavailable_material++;
            }
        }
        
        return Inertia::render('Staff/InfoMaterial', [
            'info' => [
                'available_material' => $available_material,
                'unavailable_material' => $unavailable_material,
            ],
            'listData' => $list_material,
        ]);
    }
    
    public function recapHistory() {
        $staff_id = Staff::where('user_id', '=', auth()->user()->id)->first()->id;
        $recapitulation = Recapitulation::where('staff_id', '=', $staff_id)->get();

        foreach ($recapitulation as $recap) {
            $recap->power_plant_name = PowerPlant::find($recap->power_plant_id)->name;
        }
        
        return Inertia::render('Staff/RiwayatRekap', [
            'listData' => $recapitulation,
        ]);
    }
    
    public function recapRequest() {
        $power_plant_id = Staff::where('user_id', '=', auth()->user()->id)->first()->power_plant_id;
        $recapitulation = Recapitulation::where('power_plant_id', '=', $power_plant_id)->get();

        foreach ($recapitulation as $recap) {
            $recap->power_plant_name = PowerPlant::find($recap->power_plant_id)->name;
        }
        
        return Inertia::render('Staff/PermintaanRekap', [
            'listData' => $recapitulation,
        ]);
    }
    
    public function viewRecap($id) {
        $recapitulation = Recapitulation::getRecapDetail($id);
        $log = Log::where('data_id', '=', $id)
        ->where('data_type', '=', 'Recapitulation')
        ->where('action', '=', 'Evaluate')
        ->first();
        
        $recapitulation->power_plant_name = PowerPlant::find($recapitulation->power_plant_id)->name;
        $recapitulation->power_plant_type = PowerPlant::find($recapitulation->power_plant_id)->power_plant_type;
        $recapitulation->log = $log;
        
        return Inertia::render('Staff/Rekap', [
            'data' => $recapitulation,
        ]);
    }
    
    public function evaluateRecap($id) {
        $recapitulation = Recapitulation::find($id);
        if ($recapitulation->status == 'Dibuat') {
            $recapitulation->status = 'Dievaluasi';
            $recapitulation->save();
        }
        
        $recapitulation = Recapitulation::getRecapDetail($id);
        $log = Log::where('data_id', '=', $id)
        ->where('data_type', '=', 'Recapitulation')
        ->where('action', '=', 'Evaluate')
        ->first();
        
        $recapitulation->power_plant_name = PowerPlant::find($recapitulation->power_plant_id)->name;
        $recapitulation->power_plant_type = PowerPlant::find($recapitulation->power_plant_id)->power_plant_type;
        $recapitulation->log = $log;
        
        return Inertia::render('Staff/EvaluasiRekap', [
            'data' => $recapitulation,
        ]);
    }
    
    public function saveEvaluation(Request $request) {
        $recapitulation = Recapitulation::find($request->id);
        
        if ($request->status == 'Disetujui') {
            $recapitulation->status = 'Disetujui';
            $message = null;
            
            switch ($recapitulation->recapitulation_type) {
                case 'Fast Moving':
                    $error = [];
                    $fast_moving = FastMoving::where('recapitulation_id', '=', $request->id)->get();

                    foreach ($fast_moving as $item) {
                        $material = Material::find($item->material_id);
                        if ($material->quantity < $item->quantity && $item->status != 'Penerimaan') {
                            $error[] = $material->name;
                        }
                    }
                    
                    if (count($error) > 0) {
                        return redirect()->back()->withErrors([
                            'message' => 'Jumlah material ' . implode(', ', $error) . ' tidak mencukupi'
                        ]);
                    } else {
                        foreach ($fast_moving as $item) {
                            $material = Material::find($item->material_id);
                            if($item->status != 'Penerimaan') {
                                $material->quantity = $material->quantity - $item->quantity;
                            } else {
                                $material->quantity = $material->quantity + $item->quantity;
                            }
                            $material->save();
                        }
                    }
                    break;
                case 'Gangguan':
                case 'HAR Realisasi':
                    $error = [];
                    $material_expenses = MaterialExpense::where('maintenance_id', '=', $recapitulation->id)->get();
                    
                    foreach ($material_expenses as $material_expense) {
                        $material = Material::find($material_expense->material_id);
                        if ($material->quantity < $material_expense->quantity) {
                            $error[] = $material->name;
                        }
                    }
                    
                    if (count($error) > 0) {
                        return redirect()->back()->withErrors([
                            'message' => 'Jumlah material ' . implode(', ', $error) . ' tidak mencukupi'
                        ]);
                    } else {
                        foreach ($material_expenses as $material_expense) {
                            $material = Material::find($material_expense->material_id);
                            $material->quantity = $material->quantity - $material_expense->quantity;
                            $material->save();
                        }
                    }
                    break;
                default:
                    break;
            }
        } else if ($request->status == 'Ditolak'){
            $recapitulation->status = 'Ditolak';
            $message = $request->message;
        } else {
            $recapitulation->status = 'Dievaluasi';
            
            switch ($recapitulation->recapitulation_type) {
                case 'Fast Moving':
                    $fast_moving = FastMoving::where('recapitulation_id', '=', $request->id)->get();
                    foreach ($fast_moving as $item) {
                        $material = Material::find($item->material_id);
                        if($item->status != 'Penerimaan') {
                            $material->quantity = $material->quantity + $item->quantity;
                        } else {
                            $material->quantity = $material->quantity - $item->quantity;
                        }
                        $material->save();
                    }
                    break;
                case 'Gangguan':
                case 'HAR Realisasi':
                    $material_expenses = MaterialExpense::where('maintenance_id', '=', $recapitulation->id)->get();
                    foreach ($material_expenses as $material_expense) {
                        $material = Material::find($material_expense->material_id);
                        $material->quantity = $material->quantity + $material_expense->quantity;
                        $material->save();
                    }
                    break;
                default:
                    break;
            }
        }
        
        $recapitulation->save();
        
        if (Log::where('data_id', '=', $recapitulation->id)->where('data_type', '=', 'Recapitulation')->where('action', '=', 'Evaluate')->count() > 0) {
            Log::where('data_id', '=', $recapitulation->id)->where('data_type', '=', 'Recapitulation')->where('action', '=', 'Evaluate')->delete();
        }
        
        if ($request->status != 'Dievaluasi') {
            $log = new Log();
            $log->user_id = auth()->user()->id;
            $log->data_id = $recapitulation->id;
            $log->data_type = 'Recapitulation';
            $log->action = 'Evaluate';
            $log->message = $message;
            $log->save();
        }
        
        return redirect()->route('recap.evaluate', ['id' => $request->id]);
    }
    
    public function inputRecap ($type) {
        $power_plant_id = Staff::where('user_id', '=', auth()->user()->id)->first()->power_plant_id;
        $power_plants = PowerPlant::where('id', '=', $power_plant_id)->get();
        
        $list_power_plant = [];
        
        foreach ($power_plants as $power_plant) {
            array_push($list_power_plant, [
                'name' => $power_plant->name,
                'id' => $power_plant->id,
                'type' => $power_plant->power_plant_type
            ]);
        }
        
        return Inertia::render('Staff/InputRekap', [
            'type' => $type,
            'listPowerPlant' => $list_power_plant
        ]);
    }
    
    public function createRecap (Request $request) {
        switch ($request->recapitulation_type['name'] ?? '') {
            case 'BBM Pemakaian':
                $validator = Validator::make($request->all(), (new BBMPemakaianRequest)->rules());
                break;
            case 'BBM Stok':
                $validator = Validator::make($request->all(), (new BBMStokRequest)->rules());
                break;
            case 'Beban':
                $validator = Validator::make($request->all(), (new BebanRequest)->rules());
                break;
            case 'Fast Moving':
                $validator = Validator::make($request->all(), (new FastMovingRequest)->rules());
                break;
            case 'Gangguan':
                $validator = Validator::make($request->all(), (new GangguanRequest)->rules());
                break;
            case 'HAR Realisasi':
                $validator = Validator::make($request->all(), (new HARRealisasiRequest)->rules());
                break;
            case 'HAR Rencana':
                $validator = Validator::make($request->all(), (new HARRencanaRequest)->rules());
                break;
            case 'KWH':
                $validator = Validator::make($request->all(), (new KWHRequest)->rules());
                break;
            case 'Pelumas':
                $validator = Validator::make($request->all(), (new PelumasRequest)->rules());
                break;
            case 'Utama':
                $validator = Validator::make($request->all(), (new UtamaRequest)->rules());
                break;
            default:
                return redirect()->back()->withErrors(['type' => 'Tipe rekap tidak ditemukan']);
                break;
        }
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        
        switch ($request->recapitulation_type['name'] ?? '') {
            case 'BBM Pemakaian':
                $this->savingBBMPemakaian($request);
                break;
            case 'BBM Stok':
                $this->savingBBMStok($request);
                break;
            case 'Beban':
                $this->savingBeban($request);
                break;
            case 'Fast Moving':
                $this->savingFastMoving($request);
                break;
            case 'Gangguan':
                $this->savingGangguan($request);
                break;
            case 'HAR Realisasi':
                $this->savingHARRealisasi($request);
                break;
            case 'HAR Rencana':
                $this->savingHARRencana($request);
                break;
            case 'KWH':
                $this->savingKWH($request);
                break;
            case 'Pelumas':
                $this->savingPelumas($request);
                break;
            case 'Utama':
                $this->savingUtama($request);
                break;
            default:
                return redirect()->back()->withErrors(['type' => 'Tipe rekap tidak ditemukan']);
                break;
        }
        
        return redirect()->route('recap.history');
    }
    
    public function editRecap ($id) {
        $recapitulation = Recapitulation::getRecapDetail($id);
        $power_plant_id = Staff::where('user_id', '=', auth()->user()->id)->first()->power_plant_id;
        $power_plants = PowerPlant::where('id', '=', $power_plant_id)->get();
        
        $list_power_plant = [];
        
        foreach ($power_plants as $power_plant) {
            array_push($list_power_plant, [
                'name' => $power_plant->name,
                'id' => $power_plant->id,
                'type' => $power_plant->power_plant_type
            ]);
        }
        
        return Inertia::render('Staff/EditRekap', [
            'type' => $recapitulation->recapitulation_type,
            'listPowerPlant' => $list_power_plant,
            'data' => $recapitulation,
        ]);
    }
    
    public function updateRecap (Request $request, $id) {
        switch ($request->recapitulation_type['name'] ?? '') {
            case 'BBM Pemakaian':
                $validator = Validator::make($request->all(), (new BBMPemakaianRequest)->rules());
                break;
            case 'BBM Stok':
                $validator = Validator::make($request->all(), (new BBMStokRequest)->rules());
                break;
            case 'Beban':
                $validator = Validator::make($request->all(), (new BebanRequest)->rules());
                break;
            case 'Fast Moving':
                $validator = Validator::make($request->all(), (new FastMovingRequest)->rules());
                break;
            case 'Gangguan':
                $validator = Validator::make($request->all(), (new GangguanRequest)->rules());
                break;
            case 'HAR Realisasi':
                $validator = Validator::make($request->all(), (new HARRealisasiRequest)->rules());
                break;
            case 'HAR Rencana':
                $validator = Validator::make($request->all(), (new HARRencanaRequest)->rules());
                break;
            case 'KWH':
                $validator = Validator::make($request->all(), (new KWHRequest)->rules());
                break;
            case 'Pelumas':
                $validator = Validator::make($request->all(), (new PelumasRequest)->rules());
                break;
            case 'Utama':
                $validator = Validator::make($request->all(), (new UtamaRequest)->rules());
                break;
            default:
                return redirect()->back()->withErrors(['type' => 'Tipe rekap tidak ditemukan']);
                break;
        }
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        
        switch ($request->recapitulation_type['name'] ?? '') {
            case 'BBM Pemakaian':
                $this->savingBBMPemakaian($request, $id);
                break;
            case 'BBM Stok':
                $this->savingBBMStok($request, $id);
                break;
            case 'Beban':
                $this->savingBeban($request,$id);
                break;
            case 'Fast Moving':
                $this->savingFastMoving($request, $id);
                break;
            case 'Gangguan':
                $this->savingGangguan($request, $id);
                break;
            case 'HAR Realisasi':
                $this->savingHARRealisasi($request, $id);
                break;
            case 'HAR Rencana':
                $this->savingHARRencana($request, $id);
                break;
            case 'KWH':
                $this->savingKWH($request, $id);
                break;
            case 'Pelumas':
                $this->savingPelumas($request, $id);
                break;
            case 'Utama':
                $this->savingUtama($request, $id);
                break;
            default:
                return redirect()->back()->withErrors(['type' => 'Tipe rekap tidak ditemukan']);
                break;
        }
        
        // get user_type
        if (auth()->user()->user_type == 'Staff Operator') {
            return redirect()->route('recap.history');
        } else {
            return redirect()->route('recap.evaluate', ['id' => $id]);
        }
    }
    
    public function deleteRecap ($id) {
        
        return redirect()->route('recap.history');
    }
    
    private function savingRecapitulation ($data, $id) {
        if ($id != null) {
            $recapitulation = Recapitulation::find($id);
        } else {
            $recapitulation = new Recapitulation();
        }
        
        $recapitulation->power_plant_id = $data->power_plant_id['id'];
        $recapitulation->staff_id = Staff::where('user_id', '=', auth()->user()->id)->first()->id;
        $recapitulation->recapitulation_type = $data->recapitulation_type['name'];
        $recapitulation->date_time = Carbon::parse($data->date_time)->setTimezone('Asia/Kuala_Lumpur')->toDateTimeString();
        $recapitulation->status = 'Dibuat';
        $recapitulation->save();
        
        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->data_id = $recapitulation->id;
        $log->data_type = 'Recapitulation';
        $log->action = $id != null ? 'Update' : 'Create';
        $log->save();
        
        return $recapitulation->id;
    }
    
    private function savingBBMPemakaian ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
            $fuel_id = Fuel::where('recapitulation_id', '=', $id)->first()->id;
            $fuel = Fuel::find($fuel_id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
            $fuel = new Fuel();
            $fuel->recapitulation_id = $id;
        }

        $fuel->do_reception = 0;
        $fuel->physical_reception = 0;
        $fuel->master_flow_meter = $data->master_flow_meter;
        $fuel->save();
        
        $types = [
            [
                'postfix' => 'th',
                'name' => 'Tangki Harian'
            ],
            [
                'postfix' => 'mp3',
                'name' => 'Module PCC 300'
            ],
            [
                'postfix' => 'fm',
                'name' => 'Flow Meter'
            ]
        ];
        
        $engine_quantity = PowerPlant::find($data->power_plant_id['id'])->engine_quantity ?? 0;
        foreach ($types as $type) {
            for ($i = 1; $i <= $engine_quantity; $i++) {
                $fuel_usage = FuelUsage::where('fuel_id', '=', $fuel->id)->where('unit', '=', $i)->where('type', '=', $type['name'])->first();
                if ($fuel_usage == null) {
                    $fuel_usage = new FuelUsage();
                    $fuel_usage->unit = $i;
                    $fuel_usage->amount = $data['engine_'.$i.'_'.$type['postfix']];
                    $fuel_usage->action = 'Pemakaian';
                    $fuel_usage->type = $type['name'];
                    $fuel_usage->fuel_id = $fuel->id;
                }
                $fuel_usage->amount = $data['engine_'.$i.'_'.$type['postfix']];
                $fuel_usage->save();
            }
        }
    }
    
    private function savingBBMStok ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
            $fuel_id = Fuel::where('recapitulation_id', '=', $id)->first()->id;
            $fuel = Fuel::find($fuel_id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
            $fuel = new Fuel();
            $fuel->recapitulation_id = $id;
        }

        $fuel->do_reception = $data->do_reception;
        $fuel->physical_reception = $data->physical_reception;
        $fuel->master_flow_meter = 0;
        $fuel->save();
        
        $types = [
            [
                'postfix' => 'ti',
                'name' => 'Tangki Induk'
            ],
            [
                'postfix' => 'th',
                'name' => 'Tangki Harian'
            ]
        ];
        
        $engine_quantity = PowerPlant::find($data->power_plant_id['id'])->engine_quantity ?? 0;
        foreach ($types as $type) {
            for ($i = 1; $i <= $engine_quantity; $i++) {
                $fuel_usage = FuelUsage::where('fuel_id', '=', $fuel->id)->where('unit', '=', $i)->where('type', '=', $type['name'])->first();
                if ($fuel_usage == null) {
                    $fuel_usage = new FuelUsage();
                    $fuel_usage->unit = $i;
                    $fuel_usage->amount = $data['engine_'.$i.'_'.$type['postfix']];
                    $fuel_usage->action = 'Stok';
                    $fuel_usage->type = $type['name'];
                    $fuel_usage->fuel_id = $fuel->id;
                }
                $fuel_usage->amount = $data['engine_'.$i.'_'.$type['postfix']];
                $fuel_usage->save();
            }
        }
    }
    
    private function savingBeban ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
        }
        
        $engine_quantity = PowerPlant::find($data->power_plant_id['id'])->engine_quantity ?? 0;
        for ($i = 1; $i <= $engine_quantity; $i++) {
            $load = Load::where('recapitulation_id', '=', $id)->where('unit', '=', $i)->first();
            if ($load == null) {
                $load = new Load();
                $load->unit = $i;
                $load->energy = $data['engine_'.$i];
                $load->duration = $data['duration_'.$i];
                $load->recapitulation_id = $id;
            }
            $load->energy = $data['engine_'.$i];
            $load->duration = $data['duration_'.$i];
            $load->save();
        }
    }
    
    private function savingFastMoving ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
        }
        
        $fast_moving = FastMoving::where('recapitulation_id', '=', $id)->get();
        
        if (count($fast_moving) != 0) {
            foreach ($fast_moving as $material) {
                $material = FastMoving::find($material->id);
                $material->delete();
            }
        }
        
        foreach ($data->selectedMaterial as $material) {
            $fast_moving = new FastMoving();
            $fast_moving->quantity = $material['quantity'];
            $fast_moving->material_id = $material['id'];
            $fast_moving->status = $material['status'];
            $fast_moving->recapitulation_id = $id;
            $fast_moving->save();
        }
    }
    
    private function savingGangguan ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
            $maintenance_id = Maintenance::where('recapitulation_id', '=', $id)->first()->id;
            $maintenance = Maintenance::find($maintenance_id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
            $maintenance = new Maintenance();
            $maintenance->recapitulation_id = $id;
        }
        
        $maintenance->unit = $data->unit['code'];
        $maintenance->status = $data->status['name'];
        $maintenance->description = $data->description;
        $maintenance->lh_five_no = $data->lh_five_no;
        $maintenance->save();
        
        $material_expense = MaterialExpense::where('recapitulation_id', '=', $id)->get();
        
        if (count($material_expense) != 0) {
            foreach ($material_expense as $material) {
                $material = MaterialExpense::find($material->id);
                $material->delete();
            }
        }
        
        foreach ($data->selectedMaterial as $material) {
            $material_expense = new MaterialExpense();
            $material_expense->quantity = $material['quantity'];
            $material_expense->material_id = $material['id'];
            $material_expense->recapitulation_id = $id;
            $material_expense->save();
        }
    }
    
    private function savingHARRealisasi ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
            $har_id = HAR::where('recapitulation_id', '=', $id)->first()->id;
            $har = HAR::find($har_id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
            $har = new HAR();
            $har->recapitulation_id = $id;
        }
        
        $har->unit = $data->unit['code'];
        $har->activity = $data->activity;
        $har->type = 'Realisasi';
        $har->save();
        
        $material_expense = MaterialExpense::where('recapitulation_id', '=', $id)->get();
        
        if (count($material_expense) != 0) {
            foreach ($material_expense as $material) {
                $material = MaterialExpense::find($material->id);
                $material->delete();
            }
        }
        
        foreach ($data->selectedMaterial as $material) {
            $material_expense = new MaterialExpense();
            $material_expense->quantity = $material['quantity'];
            $material_expense->material_id = $material['id'];
            $material_expense->recapitulation_id = $id;
            $material_expense->save();
        }
    }
    
    private function savingHARRencana ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
            $har_id = HAR::where('recapitulation_id', '=', $id)->first()->id;
            $har = HAR::find($har_id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
            $har = new HAR();
            $har->recapitulation_id = $id;
        }
        
        $har->unit = $data->unit['code'];
        $har->activity = $data->activity;
        $har->type = 'Rencana';

        $har->save();
    }
    
    private function savingKWH ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
        }
        
        $types = [
            [
                'postfix' => 'em',
                'name' => 'Engine Module'
            ],
            [
                'postfix' => 'kmp',
                'name' => 'KWH Meter Pembanding'
            ]
        ];
        
        $engine_quantity = PowerPlant::find($data->power_plant_id['id'])->engine_quantity ?? 0;
        foreach ($types as $type) {
            for ($i = 1; $i <= $engine_quantity; $i++) {
                $kwh = KWH::where('recapitulation_id', '=', $id)->where('unit', '=', $i)->where('type', '=', $type['name'])->first();
                if ($kwh == null) {
                    $kwh = new KWH();
                    $kwh->unit = $i;
                    $kwh->energy = $data['engine_'.$i.'_'.$type['postfix']];
                    $kwh->type = $type['name'];
                    $kwh->recapitulation_id = $id;
                }
                $kwh->energy = $data['engine_'.$i.'_'.$type['postfix']];
                $kwh->save();
            }
        }
    }
    
    private function savingPelumas ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
            $lubricant_id = Lubricant::where('recapitulation_id', '=', $id)->first()->id;
            $lubricant = Lubricant::find($lubricant_id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
            $lubricant = new Lubricant();
            $lubricant->recapitulation_id = $id;
        }

        $lubricant->first_lubricant_stock = $data->first_lubricant_stock;
        $lubricant->receipt_lubricant_stock = $data->receipt_lubricant_stock;
        $lubricant->save();
        
        $engine_quantity = PowerPlant::find($data->power_plant_id['id'])->engine_quantity ?? 0;
        for ($i = 1; $i <= $engine_quantity; $i++) {
            $lubricant_usage = LubricantUsage::where('lubricant_id', '=', $lubricant->id)->where('unit', '=', $i)->first();
            if ($lubricant_usage == null) {
                $lubricant_usage = new LubricantUsage();
                $lubricant_usage->unit = $i;
                $lubricant_usage->amount = $data['engine_'.$i];
                $lubricant_usage->lubricant_id = $lubricant->id;
            }
            $lubricant_usage->amount = $data['engine_'.$i];
            $lubricant_usage->save();
        }
    }
    
    private function savingUtama ($data, $id = null) {
        if ($id != null) {
            $this->savingRecapitulation($data, $id);
            $solar_panel_id = SolarPanel::where('recapitulation_id', '=', $id)->first()->id;
            $solar_panel = SolarPanel::find($solar_panel_id);
        } else {
            $id = $this->savingRecapitulation($data, $id);
            $solar_panel = new SolarPanel();
            $solar_panel->recapitulation_id = $id;
        }
        
        $solar_panel->installed_power = $data->installed_power;
        $solar_panel->ability = $data->ability;
        $solar_panel->load = $data->load;
        $solar_panel->early_stand = $data->early_stand;
        $solar_panel->final_stand = $data->final_stand;
        $solar_panel->kwh_production = $data->kwh_production;
        $solar_panel->har_activity = $data->har_activity;
        $solar_panel->maintenance = $data->maintenance;
        $solar_panel->save();
    }
}
