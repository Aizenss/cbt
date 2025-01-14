<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Imports\QuestionImport;
use App\Models\QuestionBank;
use App\Models\ExamBank;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class QuestionBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $examBanks = ExamBank::find($request->id);
        return view('main.question_bank.index', compact('examBanks'));
    }

    public function datatable(Request $request)
    {
        $data = $this->getDatatable($request, $request->examBankId);

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
            ->addColumn('exam_bank_id', function ($data) {
                return $data->examBank->name ?? null;
            })
            ->addColumn('subject_id', function ($data) {
                return $data->subject->name ?? null;
            })
            ->addColumn('question', function ($data) {
                return $data->question ?? null;
            })
            ->addColumn('option_a', function ($data) {
                return $data->option_a ?? null;
            })
            ->addColumn('option_b', function ($data) {
                return $data->option_b ?? null;
            })
            ->addColumn('option_c', function ($data) {
                return $data->option_c ?? null;
            })
            ->addColumn('option_d', function ($data) {
                return $data->option_d ?? null;
            })
            ->addColumn('option_e', function ($data) {
                return $data->option_e ?? null;
            })
            ->addColumn('correct_answer', function ($data) {
                return $data->correct_answer ?? null;
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

    public function getDatatable(Request $request, $examBankId = null)
    {
        $columns = [
            'id',
            'exam_bank_id',
            'subject_id',
            'question',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'option_e',
            'correct_answer',
            'created_at'
        ];

        $keyword = $request->search['value'] ?? null;

        $query = QuestionBank::orderBy('created_at', 'desc')->select($columns);

        if ($examBankId) {
            $query->where('exam_bank_id', $examBankId);
        }

        $data = $query->where(function ($query) use ($keyword, $columns) {
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
    public function create(Request $request)
    {
        //
        $examBanks = ExamBank::find($request->examBankId);
        return view('main.question_bank.create', compact('examBanks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $examBank = ExamBank::find($request->examBankId);

        try {
            $data['exam_bank_id'] = $examBank->id;
            $data['subject_id'] = $examBank->subject_id;
            $data = QuestionBank::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = QuestionBank::find($id);
        return view('main.question_bank.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();

        try {
            $data = QuestionBank::find($id)->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diubah!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = QuestionBank::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
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
            $delete = QuestionBank::whereIn('id', $decryptedIds)->delete();

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

    public function importExcel(Request $request)
    {
        $examBank = ExamBank::find($request->examBankId);
        return view('main.question_bank.import_excel', compact('examBank'));
    }

    public function importExcelStore(Request $request)
    {
        try {
            $examBank = ExamBank::findOrFail($request->examBankId);

            DB::beginTransaction();

            $import = new QuestionImport($examBank->id, $examBank->subject_id);
            Excel::import($import, $request->file('exam_file'));

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diimport!',
                'total_imported' => $import->getRowCount()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengimport data: ' . $e->getMessage()
            ], 500);
        }
    }
}
