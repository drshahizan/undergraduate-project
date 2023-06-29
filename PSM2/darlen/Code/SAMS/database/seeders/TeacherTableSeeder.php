<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            ['name' => 'Suhartina, S.Pd., M.Pd.', 'nip' => '196908311990112002'],
            ['name' => 'Juairiah, S.Pd.', 'nip' => '196212311985032035'],
            ['name' => 'Drs. A. Hamid', 'nip' => '196006051987031004'],
            ['name' => 'Melly Hastuty, S.Pd.', 'nip' => '197407272003122002'],
            ['name' => 'Mariana, S.Ag.', 'nip' => '197602042005042002'],
            ['name' => 'Herika Harahap, SE, M.Pd.', 'nip' => '197703142005042002'],
            ['name' => 'Mailisman, S.Ag, M.Pd.', 'nip' => '196805312006041001'],
            ['name' => 'Fatmawati, S.Pd,M.Pd', 'nip' => '196305121986022004'],
            ['name' => 'Efi Yuniarti, S.Pd,I', 'nip' => '198109202009042003'],
            ['name' => 'Diana Maulina, S.Pd', 'nip' => '197105082006042001'],
            ['name' => 'Azizah, S.Ag.', 'nip' => '196908311990112003'],
            ['name' => 'Darmiati, S.Pd.', 'nip' => '196908311990112004'],
            ['name' => 'Edward, S.Pd', 'nip' => '196908311990112005'],
            ['name' => 'Yuliana, S.Pd.', 'nip' => '196908311990112006'],
            ['name' => 'Rahmawati, S.Pd.', 'nip' => '196908311990112007'],
            ['name' => 'Cindi Paramita Februari, S.Pd', 'nip' => '196908311990112008'],
            ['name' => 'Adi Sarisma, S.Pd.I.', 'nip' => '196908311990112009'],
            ['name' => 'Siska Suryani, S.Pd', 'nip' => '196908311990112012'],
            ['name' => 'Dian Manya, S.Pd', 'nip' => '196908311990112022'],
        ];

        foreach ($teachers as $teacher) {
            // Extract first name from the full name
            $firstName = explode(' ', trim($teacher['name']))[0];

            // Create a User for the Teacher
            $user = DB::table('users')->insertGetId([
                'username' => Str::slug($firstName),
                'email' => Str::slug($firstName).'@gmail.com',
                'password' => Hash::make(substr($teacher['nip'], 0, 8)), // use first 8 digits of NIP as password
                'userType' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create the Teacher```php
            DB::table('teachers')->insert([
                'user_id' => $user,
                'name' => $teacher['name'],
                'nip' => $teacher['nip'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
