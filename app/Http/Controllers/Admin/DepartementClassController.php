<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepartementClass;
use Illuminate\Http\Request;

class DepartementClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.departement_class.index');
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
            ->addColumn('fullname', function ($data) {
                return $data->grade_level . ' ' . $data->alias . ' ' . $data->identity;
            })
            ->addColumn('departement_id', function ($data) {
                return $data->departement->name ?? null;
            })
            ->addColumn('alias', function ($data) {
                return $data->alias ?? null;
            })
            ->addColumn('identity', function ($data) {
                return $data->identity ?? null;
            })
            ->addColumn('grade_level', function ($data) {
                return $data->grade_level ?? null;
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
            'departement_id',
            'alias',
            'identity',
            'grade_level',
            'created_at'
        ];

        $keyword = $request->search['value'] ?? null;
        $department_id = $request->department_id ?? null;

        $data = DepartementClass::orderBy('created_at', 'desc')->select($columns)->where(function ($query) use ($keyword, $columns) {
            if ($keyword != '') {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
                }
            }
        });

        if ($department_id) {
            $data->where('departement_id', $department_id);
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.departement_class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            DepartementClass::create($request->all());
            return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = DepartementClass::find($id);
        return view('admin.departement_class.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = DepartementClass::find($id);
        return view('admin.departement_class.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            DepartementClass::find($id)->update($request->all());
            return response()->json(['status' => true, 'message' => 'Data berhasil diubah']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            DepartementClass::find($id)->delete();
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
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
            $delete = DepartementClass::whereIn('id', $decryptedIds)->delete();

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
