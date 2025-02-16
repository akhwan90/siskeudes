<?php

namespace App\Http\Controllers\Api\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Pemda;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    //
    public function index($kdProv, $kdKab) {
        $datas = Kecamatan::where('kode_prov', $kdProv)
        ->where('kode_kab', $kdKab)
        ->get();

        return response()->json([
            'datas'=>$datas,
        ]);
    }

    public function save(Request $request, $kdProv, $kdKab) {
        $validated  = request()->validate([
            // 'kode_prov' => 'required',
            // 'kode_kab' => 'required',
            'kode_kec' => 'required',
            'nama' => 'required',
            'mode' => 'required',
        ]);

        if ($request->mode == 'create') {
            $kec = new Kecamatan();
            $kec->kode_prov = $kdProv;
            $kec->kode_kab = $kdKab;
            $kec->kode_kec = $request->kode_kec;
            $kec->kode_gabung = $kdProv.$kdKab.$request->kode_kec;
            $kec->nama = $request->nama;
            $kec->save();

        } else if ($request->mode == 'update') {
            $kec = Kecamatan::where('kode_gabung', $request->kode_gabung)->firstOrFail();
            $kec->kode_kec = $request->kode_kec;
            $kec->kode_gabung = $kdProv . $kdKab . $request->kode_kec;
            $kec->nama = $request->nama;
            $kec->save();
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
            'message'=>'Data disimpan',
        ]);
    }

    public function remove(Request $request, $kdProv, $kdKab, $kdKec) {
        $kdGabung = $kdProv.$kdKab.$kdKec;

        $kec = Kecamatan::where('kode_gabung', $kdGabung)
        ->firstOrFail();

        $kec->delete();

        return response()->json([
           'message'=>'Data dihapus',
           'data'=> $kec,
        ]);
    }
}
