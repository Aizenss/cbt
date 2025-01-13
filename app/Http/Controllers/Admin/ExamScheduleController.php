<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamBank;
use App\Models\ExamSchedule;
use App\Models\QuestionBank;
use App\Models\ShareExam;
use App\Models\Student;
use Illuminate\Http\Request;

class ExamScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.exam_schedule.index');
    }


    public function datatable(Request $request)
    {
        $data = $this->getDatatable($request);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($data) {
                $checkbox =
                    '<div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox" id="checkbox' .
                    $data->id .
                    '" type="checkbox" value="' .
                    $data->id .
                    '" />
                    <label class="custom-control-label" for="checkbox' .
                    $data->id .
                    '"></label>
                </div>';

                return $checkbox;
            })
            ->addColumn('id', function ($data) {
                return $data->id ?? null;
            })
            ->addColumn('exam_bank_id', function ($data) {
                return $data->examBank->name ?? null;
            })
            ->addColumn('exam_date', function ($data) {
                return $data->exam_date ?? null;
            })
            ->addColumn('exam_title', function ($data) {
                return $data->exam_title . '(' . $data->examBank->subject->name . ')' ?? null;
            })
            ->addColumn('grade_level', function ($data) {
                return $data->grade_level ?? null;
            })
            ->addColumn('total_question', function ($data) {
                return $data->total_question ?? null;
            })
            ->addColumn('total_time', function ($data) {
                return $data->total_time ?? null;
            })
            ->addColumn('can_be_completed_time', function ($data) {
                return $data->can_be_completed_time ?? null;
            })
            ->addColumn('action', function ($data) {
                $btn = '<div class="d-flex">';
                $btn .= '<a href="javascript:void(0);" class="btn btn-primary btn-sm me-1" title="Pembagian Soal" onclick="showData(\'' . $data->id . '\')">Pembagian Soal</a>';
                $btn .= '<a href="javascript:void(0);" class="btn btn-primary btn-sm me-1" title="Edit Data" onclick="editData(\'' . $data->id . '\')"><i class="ti ti-pencil"></i></a>';
                $btn .= '<a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Hapus Data" onclick="deleteData(\'' . $data->id . '\')"><i class="ti ti-trash"></i></a>';
                $btn .= '</div>';
                return $btn;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getDatatable(Request $request)
    {
        $columns = [
            'id',
            'exam_bank_id',
            'exam_date',
            'exam_title',
            'grade_level',
            'total_question',
            'total_time',
            'can_be_completed_time',
            'created_at'
        ];

        $keyword = $request->search['value'] ?? null;

        $data = ExamSchedule::orderBy('created_at', 'desc')->select($columns)->where(function ($query) use ($keyword, $columns) {
            if ($keyword != '') {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
                }
            }
        });

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.exam_schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            try {
                $ExamBank = ExamBank::findOrFail($data['exam_bank_id']);
                if ($ExamBank->grade_level != $data['grade_level']) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Bank ujian ' . $ExamBank->subject->name . ' dengan tingkat kelas ' . $data['grade_level'] . ' tidak ditemukan'
                    ]);
                }

                $data['total_question'] = QuestionBank::where('exam_bank_id', $ExamBank->id)->count();

                ExamSchedule::create($data);
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Bank ujian tidak ditemukan'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal disimpan'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = ExamSchedule::find($id);
        $soal = QuestionBank::where('exam_bank_id', $data->exam_bank_id)->count();
        return view('admin.exam_schedule.show', compact('data', 'soal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = ExamSchedule::find($id);
        return view('admin.exam_schedule.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $data = $request->all();
            ExamSchedule::find($id)->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal diubah'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            ExamSchedule::find($id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal dihapus'
            ]);
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
            $delete = ExamSchedule::whereIn('id', $decryptedIds)->delete();

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

    public function share(string $id)
    {
        $data = ExamSchedule::find($id);
        $departementClass = $data->examBank->department->name;
        $shareExam = ShareExam::where('exam_schedule_id', $data->id)->get();
        $shareExamSelected = [];
        foreach ($shareExam as $key => $value) {
            $value['name'] = $value->class->grade_level . ' ' . $value->class->alias . ' ' . $value->class->identity;
            $value['id'] = $value['id'];
            $shareExamSelected[] = $value;
        }
        return view('admin.exam_schedule.share', compact('data', 'shareExamSelected'));
    }

    public function shareStore(Request $request)
    {
        try {
            foreach ($request->class_id as $classId) {
                ShareExam::updateOrCreate([
                    'exam_schedule_id' => $request->exam_schedule_id,
                    'class_id' => $classId,
                ], []);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal disimpan'
            ]);
        }
    }

    public function datatableStudent(Request $request)
    {
        $data = $this->getDatatableStudent($request);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($data) {
                $checkbox =
                    '<div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox" id="checkbox' .
                    $data->id .
                    '" type="checkbox" value="' .
                    $data->id .
                    '" />
                    <label class="custom-control-label" for="checkbox' .
                    $data->id .
                    '"></label>
                </div>';

                return $checkbox;
            })
            ->addColumn('id', function ($data) {
                return $data->id ?? null;
            })
            ->addColumn('departement_class_id', function ($data) {
                return ($data->departementClass->grade_level ?? null) . ' ' . ($data->departementClass->alias ?? null) . ' ' . ($data->departementClass->identity ?? null) ?? null;
            })
            ->addColumn('name', function ($data) {
                return $data->name ?? null;
            })
            ->addColumn('nis', function ($data) {
                return $data->nis ?? null;
            })
            ->addColumn('nisn', function ($data) {
                return $data->nisn ?? null;
            })
            ->addColumn('gender', function ($data) {
                return $data->gender ?? null;
            })
            ->addColumn('phone', function ($data) {
                return $data->phone ?? null;
            })
            ->addColumn('email', function ($data) {
                return $data->email ?? null;
            })
            ->addColumn('address', function ($data) {
                return $data->address ?? null;
            })
            ->addColumn('action', function ($data) {
                $btn = '<div class="d-flex">';
                $btn .= '<a href="javascript:void(0);" class="btn btn-primary btn-sm me-1" title="Edit Data" onclick="editData(\'' . $data->id . '\')"><i class="ti ti-pencil"></i></a>';
                $btn .= '<a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Hapus Data" onclick="deleteData(\'' . $data->id . '\')"><i class="ti ti-trash"></i></a>';
                $btn .= '</div>';
                return $btn;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getDatatableStudent(Request $request)
    {
        $columns = [
            'id',
            'departement_class_id',
            'name',
            'nisn',
            'nis',
            'gender',
            'phone',
            'email',
            'address',
            'created_at'
        ];

        $keyword = $request->search['value'] ?? null;
        $examScheduleId = $request->exam_schedule_id ?? null;

        $examSchedules = ShareExam::where('exam_schedule_id', $examScheduleId)->get();

        $data = Student::orderBy('created_at', 'desc')->select($columns)->where(function ($query) use ($keyword, $columns) {
            if ($keyword != '') {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
                }
            }
        });

        if ($examSchedules) {
            $classIds = $examSchedules->pluck('class_id')->toArray();
            $data = $data->whereIn('departement_class_id', $classIds);
        } else {
            $data = $data->where('id', null);
        }

        return $data;
    }
}
