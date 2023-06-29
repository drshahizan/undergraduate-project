<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recapitulation extends Model
{
    use HasFactory;
    
    protected $table = 'recapitulation';
    
    public static function countRecapitulation($power_plant_id, $recapitulation_type) {
        return Recapitulation::where('power_plant_id', '=', $power_plant_id)
        ->where('recapitulation_type', '=', $recapitulation_type)
        ->count();
    }
    
    public static function getRecapDetail($id) {
        $recapitulation = Recapitulation::find($id);
        $recapitulation->power_plant_name = PowerPlant::find($recapitulation->power_plant_id)->name;
        $recapitulation->power_plant_type = PowerPlant::find($recapitulation->power_plant_id)->power_plant_type;
        switch ( $recapitulation->recapitulation_type) {
            case 'BBM Pemakaian':
                $recapitulation->detail = Recapitulation::getBBMPemakaian($id);
                break;
            case 'BBM Stok':
                $recapitulation->detail = Recapitulation::getBBMStok($id);
                break;
            case 'Beban':
                $recapitulation->detail = Recapitulation::getBeban($id);
                break;
            case 'Fast Moving':
                $recapitulation->detail = Recapitulation::getFastMoving($id);
                break;
            case 'Gangguan':
                $recapitulation->detail = Recapitulation::getGangguan($id);
                break;
            case 'HAR Realisasi':
                $recapitulation->detail = Recapitulation::getHARRealisasi($id);
                break;
            case 'HAR Rencana':
                $recapitulation->detail = Recapitulation::getHARRencana($id);
                break;
            case 'KWH':
                $recapitulation->detail = Recapitulation::getKWH($id);
                break;
            case 'Pelumas':
                $recapitulation->detail = Recapitulation::getPelumas($id);
                break;
            case 'Utama':
                $recapitulation->detail = Recapitulation::getUtama($id);
                break;
            default:
                return redirect()->back()->withErrors(['type' => 'Tipe rekap tidak ditemukan']);
                break;
        }
        
        return $recapitulation;
    }

    public static function getBBMPemakaian ($id = null) {
        if($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'BBM Pemakaian')->get();
            $fuel = [];
            
            foreach ($recapitulation as $recapitulation_item) {
                $object = Recapitulation::getBBMPemakaian($recapitulation_item->id);
                $object->date_time = $recapitulation_item->date_time;
                $object->created_at = $recapitulation_item->created_at;
                
                array_push($fuel, $object);
            }
        } else {
            $fuel = Fuel::where('recapitulation_id', '=', $id)->first();
            $fuel_usages = FuelUsage::where('fuel_id', '=', $fuel->id)->get();
            
            $types = [
                'Tangki Harian' => 'th',
                'Module PCC 300' => 'mp3',
                'Flow Meter' => 'fm',
            ];

            foreach ($fuel_usages as $fuel_usage_item) {
                $fuel['engine_'.$fuel_usage_item->unit.'_'.$types[$fuel_usage_item->type]] = $fuel_usage_item->amount;
            }
        }
        
        return $fuel;
    }
    
    public static function getBBMStok ($id = null) {
        if($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'BBM Stok')->get();
            $fuel = [];
            
            foreach ($recapitulation as $recapitulation_item) {
                $object = Recapitulation::getBBMStok($recapitulation_item->id);
                $object->date_time = $recapitulation_item->date_time;
                $object->created_at = $recapitulation_item->created_at;
                
                array_push($fuel, $object);
            }     
        } else {
            $fuel = Fuel::where('recapitulation_id', '=', $id)->first();
            $fuel_usages = FuelUsage::where('fuel_id', '=', $fuel->id)->get();
            
            $types = [
                'Tangki Induk' => 'ti',
                'Tangki Harian' => 'th',
            ];
            
            foreach ($fuel_usages as $fuel_usage_item) {
                $fuel['engine_'.$fuel_usage_item->unit.'_'.$types[$fuel_usage_item->type]] = $fuel_usage_item->amount;
            }        
        }
        
        return $fuel;
    }
    
    public static function getBeban ($id = null) {
        if ($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'Beban')->get();
            $load = [];
            foreach ($recapitulation as $recapitulation_item) {
                $object = new \stdClass();
                $loads = Load::where('recapitulation_id', '=', $recapitulation_item->id)->get();
                foreach ($loads as $load_item) {
                    $object->{'engine_' . $load_item->unit} = $load_item->energy;
                    $object->{'duration_' . $load_item->unit} = $load_item->duration;
                }
                $object->date_time = $recapitulation_item->date_time;
                $object->created_at = $recapitulation_item->created_at;
    
                array_push($load, $object);
            }
        } else {
            $loads = Load::where('recapitulation_id', '=', $id)->get();
            $load = [];
            foreach ($loads as $load_item) {
                $load['engine_' . $load_item->unit] = $load_item->energy;
                $load['duration_' . $load_item->unit] = $load_item->duration;
            }
        }
    
        return $load;
    }
    
    public static function getFastMoving ($id = null) {
        if ($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'Fast Moving')->get();
            $fast_moving = [];
            
            foreach ($recapitulation as $recapitulation_item) {
                $object = Recapitulation::getFastMoving($recapitulation_item->id);
                $object->date_time = $recapitulation_item->date_time;
                $object->created_at = $recapitulation_item->created_at;
                
                array_push($fast_moving, $object);
            }
        } else {
            $fast_moving = new \stdClass();
            $material= [];
            
            $materials = FastMoving::where('recapitulation_id', '=', $id)->get();
            
            foreach ($materials as $material_item) {
                $object = new \stdClass();
                
                $object->id = $material_item->material_id;
                $object->material = Material::find($material_item->material_id)->description;
                $object->quantity = $material_item->quantity;
                $object->status = $material_item->status;
                
                array_push($material, $object);
            }
            
            $fast_moving->selectedMaterial = $material;
        }
        
        return $fast_moving;
    }
    
    public static function getGangguan ($id = null) {
        if ($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'Gangguan')->get();
            $maintenance = [];
            
            foreach ($recapitulation as $recapitulation_item) {
                $object = Recapitulation::getGangguan($recapitulation_item->id);
                $object->date_time = $recapitulation_item->date_time;
                $object->created_at = $recapitulation_item->created_at;
                
                array_push($maintenance, $object);
            }

        } else {
            $maintenance = Maintenance::where('recapitulation_id', '=', $id)->first();
            $material= [];
            
            $material_expense = MaterialExpense::where('recapitulation_id', '=', $id)->get();
            
            foreach ($material_expense as $material_expense_item) {
                $object = new \stdClass();
                
                $object->id = $material_expense_item->material_id;
                $object->material = Material::find($material_expense_item->material_id)->description;
                $object->quantity = $material_expense_item->quantity;
                
                array_push($material, $object);
            }
            
            $maintenance->selectedMaterial = $material;
        }
        
        return $maintenance;
    }
    
    public static function getHARRealisasi ($id = null) {
        if($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'HAR Realisasi')->get();
            $har = [];
            
            foreach ($recapitulation as $recapitulation_item) {
                $object = Recapitulation::getHARRealisasi($recapitulation_item->id);
                $object->date_time = $recapitulation_item->date_time;
                $object->created_at = $recapitulation_item->created_at;
                
                array_push($har, $object);
            }
        } else {
            $har = HAR::where('recapitulation_id', '=', $id)->first();
            $material= [];
            
            $material_expense = MaterialExpense::where('recapitulation_id', '=', $id)->get();
            
            foreach ($material_expense as $material_expense_item) {
                $object = new \stdClass();
                
                $object->id = $material_expense_item->material_id;
                $object->material = Material::find($material_expense_item->material_id)->description;
                $object->quantity = $material_expense_item->quantity;
                
                array_push($material, $object);
            }
            
            $har->selectedMaterial = $material;
        }

        return $har;
    }
    
    public static function getHARRencana ($id = null) {
        if($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'HAR Rencana')->get();
            $har = HAR::whereIn('recapitulation_id', $recapitulation->pluck('id'))->get();
            foreach ($har as $har_item) {
                $har_item->date_time = Recapitulation::find($har_item->recapitulation_id)->date_time;
            }
        } else {
            $har = HAR::where('recapitulation_id', '=', $id)->first();
        }

        return $har;
    }
    
    public static function getKWH ($id = null) {
        $kwh = [];
        
        if($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'KWH')->get();
            $kwhs = KWH::whereIn('recapitulation_id', $recapitulation->pluck('id'))->get();
        
            $types = [
                'Engine Module' => 'em',
                'KWH Meter Pembanding' => 'kmp',
            ];
            
            foreach ($kwhs as $kwh_item) {
                $kwh[$kwh_item->recapitulation_id]['engine_'.$kwh_item->unit.'_'.$types[$kwh_item->type]] = $kwh_item->energy;
            }
            
            foreach($recapitulation as $recapitulation_item) {
                $kwh[$recapitulation_item->id]['date_time'] = $recapitulation_item->date_time;
                $kwh[$recapitulation_item->id]['created_at'] = $recapitulation_item->created_at;
            }
        } else {
            $kwhs = KWH::where('recapitulation_id', '=', $id)->get();
        
            $types = [
                'Engine Module' => 'em',
                'KWH Meter Pembanding' => 'kmp',
            ];
            
            foreach ($kwhs as $kwh_item) {
                $kwh['engine_'.$kwh_item->unit.'_'.$types[$kwh_item->type]] = $kwh_item->energy;
            }
        }

        return $kwh;
    }
    
    public static function getPelumas ($id = null) {
        if($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'Pelumas')->get();
            $lubricant = Lubricant::whereIn('recapitulation_id', $recapitulation->pluck('id'))->get();
            foreach ($lubricant as $lubricant_item) {
                $lubricant_usages = LubricantUsage::where('lubricant_id', '=', $lubricant_item->id)->get();
                foreach ($lubricant_usages as $lubricant_usage) {
                    $lubricant_item['engine_'.$lubricant_usage->unit] = $lubricant_usage->amount;
                }
                
                $lubricant_item->date_time = Recapitulation::find($lubricant_item->recapitulation_id)->date_time;
            }
        } else {
            $lubricant = Lubricant::where('recapitulation_id', '=', $id)->first();
            $lubricant_usages = LubricantUsage::where('lubricant_id', '=', $lubricant->id)->get();
            
            foreach ($lubricant_usages as $lubricant_usage) {
                $lubricant['engine_'.$lubricant_usage->unit] = $lubricant_usage->amount;
            }
        }

        return $lubricant;
    }
    
    public static function getUtama ($id = null) {
        if ($id == null) {
            $recapitulation = Recapitulation::where('recapitulation_type', '=', 'Utama')->get();
            $solar_panel = SolarPanel::whereIn('recapitulation_id', $recapitulation->pluck('id'))->get();
            foreach ($solar_panel as $solar_panel_item) {
                $solar_panel_item->date_time = Recapitulation::find($solar_panel_item->recapitulation_id)->date_time;
            }
        } else {
            $solar_panel = SolarPanel::where('recapitulation_id', '=', $id)->first();
        }
        
        return $solar_panel;
    }

}
