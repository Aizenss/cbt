<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ExamBank;
use Illuminate\Http\Request;

class ExamBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('main.exam_bank.index');
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
            ->addColumn('subject_id', function ($data) {
                return $data->subject->name ?? null;
            })
            ->addColumn('grade_level', function ($data) {
                return $data->grade_level ?? null;
            })
            ->addColumn('department_id', function ($data) {
                return $data->department->name ?? null;
            })
            ->addColumn('passing_score', function ($data) {
                return $data->passing_score ?? null;
            })
            ->addColumn('action', function ($data) {
                $btn = '<div class="d-flex">';
                $btn .= '<a href="javascript:void(0);" class="btn btn-info btn-sm me-1" title="Show Data" onclick="showData(\'' . $data->id . '\')"><i class="ti ti-eye"></i></a>';
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
            'subject_id',
            'grade_level',
            'department_id',
            'passing_score',
            'created_at'
        ];

        $keyword = $request->search['value'] ?? null;

        $data = ExamBank::orderBy('created_at', 'desc')->select($columns)->where(function ($query) use ($keyword, $columns) {
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
        return view('main.exam_bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        try {
            $data = ExamBank::create($data);

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
        $data = ExamBank::find($id);
        return view('main.exam_bank.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = ExamBank::find($id);

        return view('main.exam_bank.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();

        try {
            $data = ExamBank::find($id)->update($data);

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
            $data = ExamBank::find($id)->delete();

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
            $delete = ExamBank::whereIn('id', $decryptedIds)->delete();

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
