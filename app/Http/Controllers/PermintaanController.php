<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Permintaan;
use Alert;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:permintaan-list|permintaan-create|permintaan-edit|permintaan-delete', ['only' => ['index','show']]);
        $this->middleware('permission:permintaan-create', ['only' => ['create','store']]);
        $this->middleware('permission:permintaan-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permintaan-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permintaans = Permintaan::latest()->paginate(5);
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin akan menghapus data ini?";
        confirmDelete($title, $text);
        return view('permintaans.index',compact('permintaans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permintaans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nama_mesin' => 'required',
            'harga_baru' => 'required',
        ]);

        permintaan::create($request->all());
        // Alert::success('Hore!', 'Post Created Successfully');
        toast('Data berhasil di Simpan!','success');

        return redirect()->route('permintaans.index');//->with('success','permintaan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function show(Permintaan $permintaan)
    {
        return view('permintaans.show',compact('permintaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Permintaan $permintaan)
    {
        return view('permintaans.edit',compact('permintaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permintaan $permintaan)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $permintaan->update($request->all());

        return redirect()->route('permintaans.index')
                        ->with('success','permintaan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permintaan $permintaan)
    {
        $permintaan->delete();
        // alert()->success('Hore!','Post Deleted Successfully');
        toast('Data berhasil dihapus!','success');
        // return redirect()->route('permintaans.index')->with('success','permintaan deleted successfully');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function showApproval(Permintaan $permintaan)
    {
        return view('permintaans.approval',compact('permintaan'));
    }

    public function getDataApproval(Request $request){
        $permintaan = Permintaan::where('id',$request->id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Permintaan',
            'data'    => $permintaan
        ]);
    }

    /**
     * approved
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function approved(Request $request, Permintaan $post)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'is_approved'     => 'require',
            // 'approved_at'   => 'harga_baru',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $post->update([
            'is_approved'   => $request->is_approved,
            'approved_at'   => now()
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $post
        ]);
    }


}