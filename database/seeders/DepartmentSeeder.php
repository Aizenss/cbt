<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Department::create(['name' => 'Rekayasa Perangkat Lunak']);
        Department::create(['name' => 'Teknik Komputer dan Jaringan']);
        Department::create(['name' => 'Teknik Pemesinan']);
        Department::create(['name' => 'Teknik Kendaraan Ringan Otomotif']);
        Department::create(['name' => 'Teknik Instalasi Tenaga Listrik']);
        Department::create(['name' => 'Tata Kecantikan Kulit dan Rambut']);
        Department::create(['name' => 'Desain Komunikasi Visual']);
        Department::create(['name' => 'Teknik Alat Berat']);
    }
}
