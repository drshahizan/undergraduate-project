<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\AdminRequest;
use App\Http\Requests\Account\StaffRequest;
use App\Models\Admin;
use App\Models\PowerPlant;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AccountController extends Controller
{
    // Manage Staff Account
    public function viewStaff() {
        $list_staff = User::rightJoin('staff', 'users.id', '=', 'staff.user_id')->get();
        foreach ($list_staff as $staff) {
            $staff->power_plant_name = PowerPlant::find($staff->power_plant_id)->name;
        }

        return Inertia::render('Admin/InformasiStaff', [
            'listData' => $list_staff
        ]);
    }
    
    public function inputStaff() {
        $power_plants = PowerPlant::all();
        
        $list_power_plant = [];
        
        foreach ($power_plants as $power_plant) {
            array_push($list_power_plant, [
                'name' => $power_plant->name,
                'id' => $power_plant->id,
                'type' => $power_plant->power_plant_type
            ]);
        }
        
        return Inertia::render('Admin/InputStaff', [
            'listPowerPlant' => $list_power_plant
        ]);
    }
    
    public function createStaff(StaffRequest $request) {
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->user_type = $request->user_type['id'];
        $user->save();
        
        $staff = new Staff();
        $staff->name = $request->name;
        $staff->user_id = $user->id;
        $staff->power_plant_id = $request->power_plant_id['id'];
        $staff->save();
        
        return redirect()->route('staff.view');
    }
    
    public function editStaff($id) {
        $staff = Staff::find($id);
        $user = User::find($staff->user_id);
        
        $staff->username = $user->username;
        $staff->user_type = $user->user_type;
        $staff->power_plant_type = PowerPlant::find($staff->power_plant_id)->power_plant_type;
        
        $power_plants = PowerPlant::all();
        
        $list_power_plant = [];
        
        foreach ($power_plants as $power_plant) {
            array_push($list_power_plant, [
                'name' => $power_plant->name,
                'id' => $power_plant->id,
                'type' => $power_plant->power_plant_type
            ]);
        }
        
        return Inertia::render('Admin/EditStaff', [
            'listPowerPlant' => $list_power_plant,
            'data' => $staff
        ]);
    }
    
    public function updateStaff(StaffRequest $request, $id) {
        $staff = Staff::find($id);
        $staff->name = $request->name;
        $staff->power_plant_id = $request->power_plant_id['id'];
        $staff->save();
        
        $user = User::find($staff->user_id);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->user_type = $request->user_type['id'];
        $user->save();
        
        return redirect()->route('staff.view');
    }
    
    public function deleteStaff($id) {
        $staff = Staff::find($id);
        $user = User::find($staff->user_id);
        
        $staff->delete();
        $user->delete();
        
        return redirect()->route('staff.view');
    }
    
    // Manage Admin Account
    public function viewAdmin() {
        $list_admin = User::rightJoin('admin', 'users.id', '=', 'admin.user_id')->get();
        
        return Inertia::render('Admin/InformasiAdmin', [
            'listData' => $list_admin
        ]);
    }
    
    public function inputAdmin() {
        return Inertia::render('Admin/InputAdmin');
    }
    
    public function createAdmin(AdminRequest $request) {
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->user_id = $user->id;
        $admin->save();
        
        return redirect()->route('admin.view');
    }
    
    public function editAdmin($id) {
        $admin = Admin::find($id);
        $user = User::find($admin->user_id);
        
        $admin->username = $user->username;
        
        return Inertia::render('Admin/EditAdmin', [
            'data' => $admin
        ]);
    }
    
    public function updateAdmin(AdminRequest $request, $id) {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->save();
        
        $user = User::find($admin->user_id);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('admin.view');
    }
    
    public function deleteAdmin($id) {
        $admin = Admin::find($id);
        $user = User::find($admin->user_id);
        
        $admin->delete();
        $user->delete();
        
        return redirect()->route('admin.view');
    }
}
