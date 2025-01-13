<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Matematika',
            'IPAS',
            'IPS',
            'PKN',
            'PJOK',
            'Seni Budaya',
            'Agama',
        ];

        foreach ($data as $item) {
            Subject::create([
                'name' => $item,
            ]);
        }
    }
}
