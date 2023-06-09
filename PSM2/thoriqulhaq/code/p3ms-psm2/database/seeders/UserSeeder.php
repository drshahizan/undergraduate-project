<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'username' => 'admin',
                    'password' => Hash::make('admin'),
                    'user_type' => 'Admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.mandangin',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.giligenting',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.giliiyang',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.sapudi',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.raas',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.kangean',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.sapeken',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.giliraja',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.sepanjang',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.pagurungankecil',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.pagurunganbesar',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.pltd.masalembu',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.tonduk',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.gowagowa',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.saobi',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.pagurungankecil',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.sakala',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.paliat',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.sabuntan',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.masakambing',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.saredengbesar',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.saredengkecil',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.talangoair',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'pic.plts.talangotengah',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff PIC',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.mandangin',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.giligenting',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.giliiyang',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.sapudi',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.raas',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.kangean',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.sapeken',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.giliraja',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.sepanjang',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.pagurungankecil',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.pagurunganbesar',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.pltd.masalembu',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.tonduk',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.gowagowa',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.saobi',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.pagurungankecil',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.sakala',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.paliat',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.sabuntan',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.masakambing',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.saredengbesar',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.saredengkecil',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.talangoair',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'username' => 'operator.plts.talangotengah',
                    'password' => Hash::make('staff'),
                    'user_type' => 'Staff Operator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
