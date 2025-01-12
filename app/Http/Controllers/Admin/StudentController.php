<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.student.index');
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
            ->addColumn('departement_class_id', function ($data) {
                return $data->departementClass->grade_level . ' ' . $data->departementClass->alias . ' ' . $data->departementClass->identity ?? null;
            })
            ->addColumn('nisn', function ($data) {
                return $data->nisn ?? null;
            })
            ->addColumn('nis', function ($data) {
                return $data->nis ?? null;
            })
            ->addColumn('name', function ($data) {
                return $data->name ?? null;
            })
            ->addColumn('gender', function ($data) {
                return $data->getGenderAttribute($data->gender) ?? null;
            })
            ->addColumn('birth_place', function ($data) {
                return $data->birth_place ?? null;
            })
            ->addColumn('birth_date', function ($data) {
                return $data->birth_date ?? null;
            })
            ->addColumn('religion', function ($data) {
                return $data->religion ?? null;
            })
            ->addColumn('address', function ($data) {
                return $data->address ?? null;
            })
            ->addColumn('phone', function ($data) {
                return $data->phone ?? null;
            })
            ->addColumn('email', function ($data) {
                return $data->email ?? null;
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

    public function getDatatable(Request $request)
    {
        $columns = [
            'id',
            'departement_class_id',
            'nisn',
            'nis',
            'name',
            'gender',
            'birth_place',
            'birth_date',
            'religion',
            'address',
            'phone',
            'email',
            'created_at'
        ];

        $keyword = $request->search['value'] ?? null;

        $data = Student::orderBy('created_at', 'desc')->select($columns)->where(function ($query) use ($keyword, $columns) {
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
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try {
            $data = $request->all();
            $data['password'] = str_replace('-', '', $data['birth_date']);

            $student = Student::create($data);

            $student->assignRole('student', 'student');

            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Ditambahkan!',
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
        $data = Student::find($id);

        return view('admin.student.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Student::find($id);

        return view('admin.student.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $data = $request->all();
            $student = Student::find($id);
            $student->update($data);
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
            $student = Student::find($id);
            $student->removeRole('student', 'student');
            $student->delete();

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

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        $decryptedIds = [];
        foreach ($ids as $encryptedId) {
            $decryptedIds[] = $encryptedId;
        }

        try {
            $delete = Student::whereIn('id', $decryptedIds)->delete();

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
