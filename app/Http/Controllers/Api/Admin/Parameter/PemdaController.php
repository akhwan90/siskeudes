<?php

namespace App\Http\Controllers\Api\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\Pemda;
use Illuminate\Http\Request;

class PemdaController extends Controller
{
    //
    public function index() {
        $data = Pemda::where('kode_gabung', '3401')->first();

        return response()->json([
            'data'=>$data,
        ]);
    }

    public function save(Request $request) {
        $validated  = request()->validate([
            'kode_gabung' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'ibukota' => 'required',
            'nama_bupati' => 'required|min:10',
        ]);

        $data = Pemda::where('kode_gabung', $request->kode_gabung)->firstOrFail();

        // dd($data);
        
        $update = Pemda::where( 'kode_gabung', $request->kode_gabung)->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'ibukota'=>$request->ibukota,
            'nama_bupati'=>$request->nama_bupati,
            'jabatan_bupati'=>$request->jabatan_bupati,
        ]);
        
        
        return response()->json([
            'message'=>'Data Pemda berhasil disimpan',
        ]);
    }
}
