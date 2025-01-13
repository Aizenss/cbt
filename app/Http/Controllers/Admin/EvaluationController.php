<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.evaluation.index');
    }

    public function datatable(Request $request)
    {
        $classId = $request->class_id;
        $examScheduleId = $request->exam_schedule_id;
        $data = $this->getDataTable($classId, $examScheduleId);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($data) {
                return '<div class="custom-control custom-checkbox">
                            <input class="custom-control-input checkbox" id="checkbox' . $data->id . '"
                                   type="checkbox" value="' . $data->id . '" />
                            <label class="custom-control-label" for="checkbox' . $data->id . '"></label>
                        </div>';
            })
            ->addColumn('student_name', function ($data) {
                return "{$data->student_name} ({$data->nis})";
            })
            ->addColumn('final_score', function ($data) {
                $score = number_format($data->final_score, 2);
                $color = $score >= $data->kkm ? 'text-success' : 'text-danger';
                return "<span class='{$color}'>{$score}</span>";
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getDataTable($classId, $examScheduleId)
    {
        $query = DB::table('students as s')
            ->join('exam_answers as ea', 'ea.student_id', '=', 's.id')
            ->join('exam_schedules as es', 'ea.exam_schedule_id', '=', 'es.id')
            ->join('exam_banks as eb', 'es.exam_bank_id', '=', 'eb.id')
            ->join('question_banks as qb', 'ea.question_bank_id', '=', 'qb.id')
            ->where('s.departement_class_id', $classId)
            ->where('ea.exam_schedule_id', $examScheduleId);

        return $query
            ->select(
                's.id',
                's.name as student_name',
                's.nisn',
                's.nis',
                DB::raw('COUNT(CASE WHEN ea.answer = qb.correct_answer THEN 1 END) as correct_answers'),
                DB::raw('COUNT(CASE WHEN ea.answer != qb.correct_answer THEN 1 END) as wrong_answers'),
                'eb.passing_score as kkm',
                DB::raw('(COUNT(CASE WHEN ea.answer = qb.correct_answer THEN 1 END) * 100.0 / COUNT(*)) as final_score')
            )
            ->groupBy('s.id', 's.name', 's.nisn', 's.nis', 'eb.passing_score');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.evaluation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $data = $request->all();
            Evaluation::create($data);
            return redirect()->route('evaluation.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('evaluation.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Evaluation::find($id);
        return view('admin.evaluation.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Evaluation::find($id);
        return view('admin.evaluation.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $data = $request->all();
            Evaluation::find($id)->update($data);
            return redirect()->route('evaluation.index')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('evaluation.index')->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            Evaluation::find($id)->delete();
            return redirect()->route('evaluation.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('evaluation.index')->with('error', 'Data gagal dihapus');
        }
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        $decryptedIds = [];
        foreach ($ids as $encryptedId) {
            $decryptedIds[] = $encryptedId;
        }

        try {
            $delete = Evaluation::whereIn('id', $decryptedIds)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
