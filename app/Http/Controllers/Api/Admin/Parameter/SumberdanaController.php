<?php

namespace App\Http\Controllers\Api\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Sumberdana;
use Illuminate\Http\Request;

class SumberdanaController extends Controller
{
    //

    public function index()
    {
        $datas = Sumberdana::orderBy('urutan', 'asc')
        ->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function save(Request $request)
    {
        $validated  = request()->validate([
            // 'kode_prov' => 'required',
            // 'kode_kab' => 'required',
            'kode' => 'required',
            'urutan' => 'required',
            'nama' => 'required',
            'mode' => 'required',
        ]);

        $message = null;
        if ($request->mode == 'create') {
            $insert = new Sumberdana();
            $insert->kode = $request->kode;
            $insert->urutan = $request->urutan;
            $insert->nama = $request->nama;
            $insert->save();
            $message = 'Data ditambahkan';
            
        } else if ($request->mode == 'update') {
            $update = Sumberdana::where('kode', $request->kode)->firstOrFail();
            $update->urutan = $request->urutan;
            $update->nama = $request->nama;
            $update->save();

            $message = 'Data diubah';
        }

        /*
        $data = Pemda::where('kode_gabung', $request->kode_gabung)->firstOrFail();

        // dd($data);
        
        $update = Pemda::where( 'kode_gabung', $request->kode_gabung)->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'ibukota'=>$request->ibukota,
            'nama_bupati'=>$request->nama_bupati,
            'jabatan_bupati'=>$request->jabatan_bupati,
        ]);
        */


        return response()->json([
            'message' => $message,
        ]);
    }

    public function remove(Request $request, $kode)
    {
        $kec = Sumberdana::where('kode', $kode)
            ->firstOrFail();

        $kec->delete();

        return response()->json([
            'message' => 'Data dihapus',
            'data' => $kec,
        ]);
    }
}
