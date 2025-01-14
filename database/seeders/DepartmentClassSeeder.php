<?php

namespace Database\Seeders;

use App\Models\DepartementClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DepartementClass::create(['alias' => 'RPL', 'departement_id' => 1, 'identity' => 1, 'grade_level' => 10]);
        DepartementClass::create(['alias' => 'RPL', 'departement_id' => 1, 'identity' => 2, 'grade_level' => 10]);
        DepartementClass::create(['alias' => 'RPL', 'departement_id' => 1, 'identity' => 1, 'grade_level' => 11]);
        DepartementClass::create(['alias' => 'RPL', 'departement_id' => 1, 'identity' => 2, 'grade_level' => 11]);
        DepartementClass::create(['alias' => 'RPL', 'departement_id' => 1, 'identity' => 1, 'grade_level' => 12]);
        DepartementClass::create(['alias' => 'RPL', 'departement_id' => 1, 'identity' => 2, 'grade_level' => 12]);

        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 1, 'grade_level' => 10]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 2, 'grade_level' => 10]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 3, 'grade_level' => 10]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 4, 'grade_level' => 10]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 5, 'grade_level' => 10]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 1, 'grade_level' => 11]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 2, 'grade_level' => 11]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 3, 'grade_level' => 11]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 4, 'grade_level' => 11]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 5, 'grade_level' => 11]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 1, 'grade_level' => 12]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 2, 'grade_level' => 12]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 3, 'grade_level' => 12]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 4, 'grade_level' => 12]);
        DepartementClass::create(['alias' => 'TKJ', 'departement_id' => 2, 'identity' => 5, 'grade_level' => 12]);
    }
}
