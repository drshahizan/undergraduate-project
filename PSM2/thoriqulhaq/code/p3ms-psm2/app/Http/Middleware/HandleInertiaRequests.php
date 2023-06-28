<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Material;
use App\Models\PowerPlant;
use App\Models\Recapitulation;
use App\Models\Staff;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $staff_id = Staff::where('user_id', '=', auth()->user()->id ?? '')->get()->first()->id ?? '';
        $power_plant_id = Staff::where('user_id', '=', auth()->user()->id ?? '')->get()->first()->power_plant_id ?? '';
        $power_plant_type = PowerPlant::find($power_plant_id)->power_plant_type ?? '';
        $engine_quantity = PowerPlant::find($power_plant_id)->engine_quantity ?? '';
        $feeder_quantity = PowerPlant::find($power_plant_id)->feeder_quantity ?? '';
        $material = Material::where('power_plant_id', '=', $power_plant_id)->get();
        
        if ((auth()->user()->user_type ?? '') == 'Admin') {
            $name = Admin::where('user_id', '=', auth()->user()->id ?? '')->get()->first()->name ?? '';
        } else {
            $name = Staff::where('user_id', '=', auth()->user()->id ?? '')->get()->first()->name ?? '';
        }
        
        $short_info = [
            'total_recap' => Recapitulation::where('power_plant_id', '=', $power_plant_id)->count(),
            'unevaluated_recap' => Recapitulation::where('power_plant_id', $power_plant_id)->whereIn('status', ['Dibuat', 'Dievaluasi'])->count(),
            'evaluated_recap' => Recapitulation::where('power_plant_id', $power_plant_id)->whereIn('status', ['Disetujui', 'Ditolak'])->count(),
        ];
        
        if ($short_info['total_recap'] > 0) {
            $short_info['percentage_of_evaluated'] = ($short_info['evaluated_recap'] / $short_info['total_recap']) * 100;
            $short_info['percentage_of_unevaluated'] = ($short_info['unevaluated_recap'] / $short_info['total_recap']) * 100;
        } else {
            $short_info['percentage_of_evaluated'] = 0;
            $short_info['percentage_of_unevaluated'] = 0;
        }
        
        return array_merge(parent::share($request), [
            'user' => [
                'id' => auth()->user()->id ?? '',
                'username' => auth()->user()->username ?? '',
                'user_type' => auth()->user()->user_type ?? '',
                'staff_id' => $staff_id,
                'name' => $name,
                'power_plant_id' => $power_plant_id,
                'power_plant_type' => $power_plant_type,
                'engine_quantity' => $engine_quantity,
                'feeder_quantity' => $feeder_quantity,
                'material' => $material,
                'short_info' => $short_info
            ]
        ]);
    }
}
