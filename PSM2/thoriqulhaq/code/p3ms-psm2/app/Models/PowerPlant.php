<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerPlant extends Model
{
    use HasFactory;
    
    protected $table = 'power_plant';
    
    public static function getCodeList($power_plant_type) {
        $list = [];
        
        $power_plants = PowerPlant::where('power_plant_type', '=', $power_plant_type)->get();
        
        foreach ($power_plants as $power_plant) {
            array_push($list, $power_plant->code);
        }
        
        return $list;
    }
}
