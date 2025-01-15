<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            // Coba parse tanggal dari Excel menggunakan Carbon
            $birthDate = null;

            if (is_numeric($row['birth_date'])) {
                // Jika tanggal dalam format Excel numeric
                $birthDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birth_date']));
            } else {
                // Coba parse dengan beberapa format umum
                $possibleFormats = ['Y-m-d', 'd-m-Y', 'Y/m/d', 'd/m/Y'];

                foreach ($possibleFormats as $format) {
                    try {
                        $birthDate = Carbon::createFromFormat($format, $row['birth_date']);
                        break;
                    } catch (\Exception $e) {
                        continue;
                    }
                }

                if (!$birthDate) {
                    throw new \Exception("Format tanggal tidak valid untuk birth_date: {$row['birth_date']}");
                }
            }

            $student = new Student([
                'name' => $row['name'],
                'nisn' => $row['nisn'],
                'nis' => $row['nis'],
                'gender' => $row['gender'],
                'birth_place' => $row['birth_place'],
                'birth_date' => $birthDate->format('Y-m-d'),
                'religion' => $row['religion'],
                'phone' => $row['phone'],
                'email' => $row['email'] ?? null,
                'address' => $row['address'],
                'departement_class_id' => $row['departement_class_id'],
                'password' => $birthDate->format('Ymd'), // Format password menjadi YYYYMMDD
            ]);

            $student->assignRole('student', 'student');
            return $student;

        } catch (\Exception $e) {
            throw new \Exception("Error pada baris data: " . json_encode($row) . "\nPesan error: " . $e->getMessage());
        }
    }
}
