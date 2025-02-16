<?php

namespace App\Http\Controllers\Api\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemda;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    //
    public function index($kdProv, $kdKab, $kdKec) {

        $datas = Desa::where('kode_prov', $kdProv)
            ->where('kode_kab', $kdKab)
            ->where('kode_kec', $kdKec)
            ->orderBy('kode_gabung', 'asc')
            ->get();


        return response()->json([
            'datas'=>$datas,
        ]);
    }

    public function save(Request $request, $kdProv, $kdKab, $kdKec) {
        $validated  = request()->validate([
            // 'kode_prov' => 'required',
            // 'kode_kab' => 'required',
            'kode_kec' => 'required',
            'nama' => 'required',
            'mode' => 'required',
        ]);

        if ($request->mode == 'create') {
            $kec = new Desa();
            $kec->kode_prov = $kdProv;
            $kec->kode_kab = $kdKab;
            $kec->kode_kec = $kdKec;
            $kec->kode_desa = $request->kode_desa;
            $kec->kode_gabung = $kdProv.$kdKab.$kdKec.$request->kode_desa;
            $kec->nama = $request->nama;
            $kec->save();

        } else if ($request->mode == 'update') {
            $kec = Desa::where('kode_gabung', $request->kode_gabung)->firstOrFail();
            $kec->kode_desa = $request->kode_desa;
            $kec->kode_gabung = $kdProv . $kdKab . $kdKec.$request->kode_desa;
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

    public function remove(Request $request, $kdProv, $kdKab, $kdKec, $kdDesa) {
        $kdGabung = $kdProv.$kdKab.$kdKec.$kdDesa;

        $desa = Desa::where('kode_gabung', $kdGabung)
        ->firstOrFail();

        $desa->delete();

        return response()->json([
           'message'=>'Data dihapus',
           'data'=> $desa,
        ]);
    }
}
