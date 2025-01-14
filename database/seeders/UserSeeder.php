<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ]);
        $guru = User::create([
            'name' => 'guru',
            'email' => 'guru@gmail.com',
            'password' => 'password',
        ]);

        $admin->assignRole('admin');
        $guru->assignRole('teacher');

        $student = Student::create([
            'name' => 'student',
            'nisn' => '1234567890',
            'nis' => '123',
            'gender' => 'L',
            'birth_place' => 'Jakarta',
            'birth_date' => '2000-01-01',
            'address' => 'Jl. Raya',
            'phone' => '081234567890',
            'email' => 'student@gmail.com',
            'password' => Hash::make('password'),
            'departement_class_id' => 5,
        ]);

        $student->assignRole('student');
    }
}
