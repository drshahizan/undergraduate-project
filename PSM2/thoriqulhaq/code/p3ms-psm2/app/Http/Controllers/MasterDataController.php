<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterData\MaterialRequest;
use App\Http\Requests\MasterData\PowerPlantRequest;
use App\Http\Requests\MasterData\UnitRequest;
use App\Models\Material;
use App\Models\PowerPlant;
use App\Models\Unit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MasterDataController extends Controller
{
    // Master Data - Manage Unit
    public function viewUnit() {
        $list_unit = Unit::all();
        
        return Inertia::render('Admin/InformasiUnit', [
            'listData' => $list_unit
        ]);
    }
    
    public function inputUnit() {
        return Inertia::render('Admin/InputUnit');
    }
    
    public function createUnit(UnitRequest $request) {
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();
        
        return redirect()->route('unit.view');
    }
    
    public function editUnit ($id) {
        $unit = Unit::find($id);
        
        return Inertia::render('Admin/EditUnit', [
            'data' => $unit
        ]);
    }
    
    public function updateUnit (UnitRequest $request, $id) {
        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->save();
        
        return redirect()->route('unit.view');
    }
    
    public function deleteUnit ($id) {
        $unit = Unit::find($id);
        $unit->delete();
        
        return redirect()->route('unit.view');
    }
    
    // Master Data - Manage Power Plant
    public function viewPowerPlant() {
        $list_power_plan = PowerPlant::all();
        
        return Inertia::render('Admin/InformasiPembangkit', [
            'listData' => $list_power_plan
        ]);
    }
    
    public function inputPowerPlant() {
        $units = Unit::all();
        
        $list_unit = [];
        
        foreach ($units as $unit) {
            array_push($list_unit, [
                'name' => $unit->name,
                'id' => $unit->id
            ]);
        }

        return Inertia::render('Admin/InputPembangkit', [
            'listUnit' => $list_unit,
        ]);
    }
    
    public function createPowerPlant(PowerPlantRequest $request) {
        $power_plant = new PowerPlant();
        $power_plant->name = $request->name;
        $power_plant->code = $request->code;
        $power_plant->engine_quantity = $request->engine_quantity;
        $power_plant->feeder_quantity = $request->feeder_quantity;
        $power_plant->estimated_usage_amount = $request->estimated_usage_amount;
        $power_plant->dead_stock_amount = $request->dead_stock_amount;
        $power_plant->power_plant_type = $request->power_plant_type['name'];
        $power_plant->unit_id = $request->unit_id['id'];
        $power_plant->save();
        
        return redirect()->route('power-plant.view');
    }
    
    public function editPowerPlant ($id) {
        $power_plant = PowerPlant::find($id);
        $units = Unit::all();
        
        $list_unit = [];
        
        foreach ($units as $unit) {
            array_push($list_unit, [
                'name' => $unit->name,
                'id' => $unit->id
            ]);
        }
        
        return Inertia::render('Admin/EditPembangkit', [
            'data' => $power_plant,
            'listUnit' => $list_unit,
        ]);
    }
    
    public function updatePowerPlant (PowerPlantRequest $request, $id) {
        $power_plant = PowerPlant::find($id);
        $power_plant->name = $request->name;
        $power_plant->code = $request->code;
        $power_plant->engine_quantity = $request->engine_quantity;
        $power_plant->feeder_quantity = $request->feeder_quantity;
        $power_plant->estimated_usage_amount = $request->estimated_usage_amount;
        $power_plant->dead_stock_amount = $request->dead_stock_amount;
        $power_plant->power_plant_type = $request->power_plant_type['name'];
        $power_plant->unit_id = $request->unit_id['id'];
        $power_plant->save();
        
        return redirect()->route('power-plant.view');
    }
    
    public function deletePowerPlant ($id) {
        $power_plant = PowerPlant::find($id);
        $power_plant->delete();
        
        return redirect()->route('power-plant.view');
    }
    
    // Master Data - Manage Material
    public function viewMaterial() {
        $power_plants = PowerPlant::all();
        $list_material = PowerPlant::rightJoin('material', 'power_plant.id', '=', 'material.power_plant_id')->get();
        
        $list_power_plant = [];
        
        foreach ($power_plants as $power_plant) {
            $name = str_replace(['PLTD ', 'PLTS '], '', $power_plant->name);
            
            array_push($list_power_plant, [
                'name' => $name,
                'id' => $power_plant->id,
                'type' => $power_plant->power_plant_type
            ]);
        }
        
        return Inertia::render('Admin/InformasiMaterial', [
            'listData' => $list_material,
            'listPowerPlant' => $list_power_plant,
        ]);
    }
    
    public function inputMaterial() {
        $power_plants = PowerPlant::all();
        
        $list_power_plant = [];
        
        foreach ($power_plants as $power_plant) {
            array_push($list_power_plant, [
                'name' => $power_plant->name,
                'id' => $power_plant->id,
                'type' => $power_plant->power_plant_type
            ]);
        }
        
        return Inertia::render('Admin/InputMaterial', [
            'listPowerPlant' => $list_power_plant
        ]);
    }
    
    public function createMaterial(MaterialRequest $request) {
        $material = new Material();
        $material->description = $request->description;
        $material->quantity = $request->quantity;
        $material->power_plant_id = $request->power_plant_id['id'];
        $material->save();
        
        return redirect()->route('material.view');
    }
    
    public function editMaterial ($id) {
        $material = Material::find($id);
        $power_plants = PowerPlant::all();
        
        $list_power_plant = [];
        
        foreach ($power_plants as $power_plant) {
            array_push($list_power_plant, [
                'name' => $power_plant->name,
                'id' => $power_plant->id,
                'type' => $power_plant->power_plant_type
            ]);
        }
        
        return Inertia::render('Admin/EditMaterial', [
            'data' => $material,
            'listPowerPlant' => $list_power_plant
        ]);
    }
    
    public function updateMaterial (MaterialRequest $request, $id) {
        $material = Material::find($id);
        $material->description = $request->description;
        $material->quantity = $request->quantity;
        $material->power_plant_id = $request->power_plant_id['id'];
        $material->save();
        
        return redirect()->route('material.view');
    }
    
    public function deleteMaterial ($id) {
        $material = Material::find($id);
        $material->delete();
        
        return redirect()->route('material.view');
    }
}
