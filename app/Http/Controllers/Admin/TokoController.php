<?php

namespace App\Http\Controllers\Admin;

use App\Models\Toko;

use App\Http\Controllers\Controller;

use App\Http\Request\Admin\TokoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;


class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Toko::query();

            return DataTables::of($query)
            ->addColumn('action', function($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
                                type="button" id="action' . $item->id . '" 
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                <a class="dropdown-item" href="' . route('toko.edit', $item->id). '">
                                    Sunting
                                </a>
                                <form action="' . route('toko.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() .'
                                    <button type="submit" class="dropdown-item text-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>';

            })
            ->editColumn('logo', function($item) {
                return $item->logo ? '<img src="'. Storage::url($item->logo) .'" style="max-height: 40px;"/>' : '';
            })
            ->rawColumns(['action', 'logo'])
            ->make();
            
        }

        return view('pages.admin.toko.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.toko.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // $data['slug'] = Str::slug($request->name);
        $data['logo'] = $request->file('logo')->store('assets/toko', 'public');

        Toko::create($data);

        return redirect()->route('toko.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Toko::findOrFail($id);

        return view('pages.admin.toko.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        // $data['slug'] = Str::slug($request->name);
        $data['logo'] = $request->file('logo')->store('assets/toko', 'public');

        $item = Toko::findOrFail($id);

        $item->update($data);

        return redirect()->route('toko.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Toko::findorFail($id);
        $item->delete();

        return redirect()->route('toko.index');
    }
}