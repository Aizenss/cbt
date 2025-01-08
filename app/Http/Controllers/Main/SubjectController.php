<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            ->addColumn('name', function ($data) {
                return $data->name ?? null;
            })
            ->addColumn('action', function ($data) {
                $btn = '<div class="d-flex">';
                $btn .= '<a href="javascript:void(0);" class="btn btn-primary btn-sm me-1" title="Show Data" onclick="showData(\'' . $data->id . '\')"><i class="ti ti-eye"></i></a>';
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
            'name',
            'created_at'
        ];

        $keyword = $request->search['value'] ?? null;

        $data = Subject::orderBy('created_at', 'asc')->select($columns)->where(function ($query) use ($keyword, $columns) {
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

        $data = Subject::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Subject::find($id);

        return view('main.exam_bank.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Subject::find($id);

        return view('main.exam_bank.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();

        $data = Subject::find($id)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Subject::find($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        $decryptedIds = [];
        foreach ($ids as $encryptedId) {
            $decryptedIds[] = $encryptedId;
        }

        $delete = Subject::whereIn('id', $decryptedIds)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Dihapus!',
        ]);
    }
}
