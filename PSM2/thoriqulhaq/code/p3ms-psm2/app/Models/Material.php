<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    
    protected $table = 'material';
    
    public static function getAvailableMaterialSummary($power_plant_type) {
        $list = [];
        
        $power_plants = PowerPlant::where('power_plant_type', '=', $power_plant_type)->get();
        
        foreach ($power_plants as $power_plant) {
            $available_material = Material::where('power_plant_id', '=', $power_plant->id)->where('quantity', '!=', 0)->get()->count();
            
            array_push($list, $available_material);
        }
        
        return $list;
    }

    public static function getUnavailableMaterialSummary($power_plant_type) {
        $list = [];
        
        $power_plants = PowerPlant::where('power_plant_type', '=', $power_plant_type)->get();
        
        foreach ($power_plants as $power_plant) {
            $unavailable_material = Material::where('power_plant_id', '=', $power_plant->id)->where('quantity', '=', 0)->get()->count();
            
            array_push($list, $unavailable_material);
        }
        
        return $list;
    }
}
