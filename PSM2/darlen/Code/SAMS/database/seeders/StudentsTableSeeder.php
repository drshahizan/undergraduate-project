<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $students = [
    ['name' => 'Arisya Zanntara', 'gender' => 'Female', 'nis' => 9443, 'nisn' => '0062226931', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Habiburrahman', 'gender' => 'Male', 'nis' => 9444, 'nisn' => '0062226935', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Gladys Putri Ferica', 'gender' => 'Female', 'nis' => 9443, 'nisn' => '0067402572', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Nurhayati', 'gender' => 'Female', 'nis' => 9448, 'nisn' => '0054837389', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Muna Anisa', 'gender' => 'Female', 'nis' => 9447, 'nisn' => '0053181420', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Silvia Putri', 'gender' => 'Female', 'nis' => 9449, 'nisn' => '0069469397', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Sofia Jasmine', 'gender' => 'Female', 'nis' => 9450, 'nisn' => '0069533651', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Irna Maulida', 'gender' => 'Female', 'nis' => 9445, 'nisn' => '0064418217', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'M. Rafiqul Bisyri', 'gender' => 'Male', 'nis' => 9443, 'nisn' => '0062226932', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Mohammad Rizky', 'gender' => 'Male', 'nis' => 9513, 'nisn' => '0065703803', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Egita Hayatun', 'gender' => 'Female', 'nis' => 9415, 'nisn' => '0053196112', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Elisa', 'gender' => 'Female', 'nis' => 9416, 'nisn' => '0051005903', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Erni Wahyuni', 'gender' => 'Female', 'nis' => 9417, 'nisn' => '0051748425', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Fauzi Murtaza', 'gender' => 'Male', 'nis' => 9418, 'nisn' => '0053544074', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Muhammad Irvandi', 'gender' => 'Male', 'nis' => 9420, 'nisn' => '0043616991', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Nadia Mulo Niara', 'gender' => 'Female', 'nis' => 9422, 'nisn' => '0058015905', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Asmaul Husna', 'gender' => 'Female', 'nis' => 9423, 'nisn' => '3040583720', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Syaza Atiyah Midori', 'gender' => 'Female', 'nis' => 9424, 'nisn' => '0057002554', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Heriadi', 'gender' => 'Male', 'nis' => 9430, 'nisn' => '0058473737', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Cut Revina Putri Aditya', 'gender' => 'Female', 'nis' => 9433, 'nisn' => '0032237261', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Muhammad Ridho', 'gender' => 'Male', 'nis' => 9440, 'nisn' => '0062226937', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Ade Putra Kusuma', 'gender' => 'Male', 'nis' => 9459, 'nisn' => '3045811768', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Sheila Faiqah Aurora', 'gender' => 'Female', 'nis' => 9460, 'nisn' => '0053357399', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Awal Hidayat Marpaung', 'gender' => 'Male', 'nis' => 9490, 'nisn' => '0067683477', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Raudhatul Intan Rosania', 'gender' => 'Female', 'nis' => 9510, 'nisn' => '0058233890', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Muhammad Syahrul', 'gender' => 'Male', 'nis' => 9421, 'nisn' => '0049654696', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Sinta Rani', 'gender' => 'Female', 'nis' => 9425, 'nisn' => '3048326938', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Teuku Raja Tasbih Maulana', 'gender' => 'Male', 'nis' => 9426, 'nisn' => '0048508883', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Busli Amin', 'gender' => 'Male', 'nis' => 9427, 'nisn' => '0044003584', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Ulil Amri', 'gender' => 'Male', 'nis' => 9428, 'nisn' => '0049073981', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Ilham Tanasya', 'gender' => 'Male', 'nis' => 9429, 'nisn' => '0020379817', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Safutra Hanafi', 'gender' => 'Male', 'nis' => 9434, 'nisn' => '0044950002', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Fathir Mahendra', 'gender' => 'Male', 'nis' => 9458, 'nisn' => '0051051121', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Syahril Ramadhana', 'gender' => 'Male', 'nis' => 9463, 'nisn' => '3054152246', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Elen Ahmadi', 'gender' => 'Male', 'nis' => 9461, 'nisn' => '0052164723', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Ilham Rahmat Muliadi', 'gender' => 'Male', 'nis' => 9457, 'nisn' => '0052058521', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Aditya Syaputra', 'gender' => 'Male', 'nis' => 9499, 'nisn' => '0036949848', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Dimas Aditya', 'gender' => 'Male', 'nis' => 9503, 'nisn' => '0034663839', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'MIPA'],
    ['name' => 'Nabil Hawari', 'gender' => 'Male', 'nis' => 9508, 'nisn' => '0055343902', 'semester' => 'Ganjil', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
    ['name' => 'Annisa Ramadhani', 'gender' => 'Female', 'nis' => 9511, 'nisn' => '0042143368', 'semester' => 'Genap', 'academicYear' => '2021/2022', 'peminatan' => 'IPS'],
];


        // Get all classrooms
        $classrooms = DB::table('classrooms')->pluck('id')->toArray();
        $classroomIndex = 0;

        
        foreach ($students as $student) {
            // Extract last name from the full name
            $names = explode(' ', trim($student['name']));
            $lastName = end($names);

            // Create a User for the Student
            $user = DB::table('users')->insertGetId([
                'username' => Str::slug($lastName),
                'email' => Str::slug($lastName).'@gmail.com',
                'password' => Hash::make($student['nisn']), // use NIS as password
                'userType' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ]);

             // Assign the student to a classroom
            $classroomId = $classrooms[$classroomIndex];
            // Create the Student with the User's ID and Classroom ID
            DB::table('students')->insert([
                'user_id' => $user,
                'name' => $student['name'],
                'gender' => $student['gender'],
                'nis' => $student['nis'],
                'nisn' => $student['nisn'],
                'semester' => $student['semester'],
                'academicYear' => $student['academicYear'],
                'peminatan' => $student['peminatan'],
                'classroom_id' => $classroomId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            

            $classroomIndex = ($classroomIndex + 1) % count($classrooms);
        }

        // Update the totalStudent field in the classrooms table
            foreach ($classrooms as $classroom_id) {
            $totalStudents = DB::table('students')->where('classroom_id', $classroom_id)->count();
            DB::table('classrooms')->where('id', $classroom_id)->update(['totalStudent' => $totalStudents]);
        }
    }
}
