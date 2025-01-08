<?php

namespace App\Imports;

use App\Models\QuestionBank;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToModel, WithHeadingRow
{
    private $examBankId;
    private $subjectId;
    private $rowCount = 0;

    public function __construct($examBankId, $subjectId)
    {
        $this->examBankId = $examBankId;
        $this->subjectId = $subjectId;
    }

    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $this->rowCount++;

        $correctAnswer = $row['kunci_jawaban'];

        if ($correctAnswer === 'a' || $correctAnswer === 'A') {
            $correctAnswer = 'option_a';
        } elseif ($correctAnswer === 'b' || $correctAnswer === 'B') {
            $correctAnswer = 'option_b';
        } elseif ($correctAnswer === 'c' || $correctAnswer === 'C') {
            $correctAnswer = 'option_c';
        } elseif ($correctAnswer === 'd' || $correctAnswer === 'D') {
            $correctAnswer = 'option_d';
        } elseif ($correctAnswer === 'e' || $correctAnswer === 'E') {
            $correctAnswer = 'option_e';
        }

        return new QuestionBank([
            'exam_bank_id' => $this->examBankId,
            'subject_id' => $this->subjectId,
            'question' => $row['soal'],
            'option_a' => $row['jawaban_a'],
            'option_b' => $row['jawaban_b'],
            'option_c' => $row['jawaban_c'],
            'option_d' => $row['jawaban_d'],
            'option_e' => $row['jawaban_e'],
            'correct_answer' => $correctAnswer,
        ]);
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }
}
