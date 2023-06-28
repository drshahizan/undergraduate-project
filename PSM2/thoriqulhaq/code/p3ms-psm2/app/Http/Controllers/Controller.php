<?php

namespace App\Http\Controllers;
use App\Models\Material;
use App\Models\PowerPlant;
use App\Models\Recapitulation;
use App\Models\Staff;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function StaffDashboard(Request $request) {
        $power_plant_id = Staff::where('user_id', '=', auth()->user()->id ?? '')->get()->first()->power_plant_id ?? '';
        
        $dashboard_data = [
            'info_1' => [
                'total_created_recap' => Recapitulation::where('power_plant_id', $power_plant_id)->where('status', '=', 'Dibuat')->count(),
                'total_on_progress_evaluate_recap' => Recapitulation::where('power_plant_id', $power_plant_id)->where('status', '=', 'Dievaluasi')->count(),
                'total_approved_recap' => Recapitulation::where('power_plant_id', $power_plant_id)->where('status', '=', 'Disetujui')->count(),
                'total_rejected_recap' => Recapitulation::where('power_plant_id', $power_plant_id)->where('status', '=', 'Ditolak')->count(),
            ],
            'info_2' => [
                'chart' => [
                    'label' => ['BBM Pemakaian', 'BBM Stok', 'Beban', 'Fast Moving', 'Gangguan', 'HAR Realisasi', 'HAR Rencana', 'KWH', 'Pelumas'],
                    'data' => [
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'BBM Pemakaian'
                        ),
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'BBM Stok'
                        ),
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'Beban'
                        ),
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'Fast Moving'
                        ),
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'Gangguan'
                        ),
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'HAR Realisasi'
                        ),
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'HAR Rencana'
                        ),
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'KWH'
                        ),
                        Recapitulation::countRecapitulation(
                            $power_plant_id,
                            'Pelumas'
                        )
                    ]
                ],
                'total_recap' => Recapitulation::where('power_plant_id', '=', $power_plant_id)->count()
            ],
            'info_3' => [
                'filter' => [
                    'date' => now(),
                    'power_plant_type' => 'PLTD',
                ],
                'chart' => [
                    [
                        'name' => 'Stok BBM (PLTD)',
                        'label' => PowerPlant::getCodeList('PLTD'),
                        'data' => [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56]
                    ],
                    [
                        'name' => 'Pemakaian BBM (PLTD)',
                        'label' => PowerPlant::getCodeList('PLTD'),
                        'data' => [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56]
                    ],
                    [
                        'name' => 'KWH Produksi (PLTD)',
                        'label' => PowerPlant::getCodeList('PLTD'),
                        'data' => [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56]
                    ],
                    [
                        'name' => 'SFC (PLTD)',
                        'label' => PowerPlant::getCodeList('PLTD'),
                        'data' => [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56]
                    ],
                    [
                        'name' => 'HOP (PLTD)',
                        'label' => PowerPlant::getCodeList('PLTD'),
                        'data' => [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56]
                    ]
                ]
            ]
        ];
        return Inertia::render('Staff/Dashboard', [
            'data' => $dashboard_data
        ]);
    }
    
    public function AdminDashboard() {
        $dashboard_data = [
            'info_1' => [
                'total_staff_pic' => User::where('user_type', '=', 'Staff PIC')->get()->count(),
                'total_staff_operator' => User::where('user_type', '=', 'Staff Operator')->get()->count(),
            ],
            'info_2' => [
                'chart_info_material_plts' => [
                    'label' => PowerPlant::getCodeList('PLTS'),
                    'data' => [
                        'tersedia' => Material::getAvailableMaterialSummary('PLTS'),
                        'tidak_tersedia' => Material::getUnavailableMaterialSummary('PLTS')
                    ],
                ]
            ],
            'info_3' => [
                'chart_info_material_pltd' => [
                    'label' => PowerPlant::getCodeList('PLTD'),
                    'data' => [
                        'tersedia' => Material::getAvailableMaterialSummary('PLTD'),
                        'tidak_tersedia' => Material::getUnavailableMaterialSummary('PLTD')
                    ],
                ]
            ],
            'info_4' => [
                'total_unit' => Unit::all()->count(),
                'total_power_plant' => PowerPlant::all()->count(),
            ],
        ];
        
        return Inertia::render('Admin/Dashboard', [
            'data' => $dashboard_data
        ]);
    }
}
