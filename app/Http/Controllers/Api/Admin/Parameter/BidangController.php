<?php

namespace App\Http\Controllers\Api\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    //

    public function index()
    {
        $datas = Bidang::orderBy('kode_bidang', 'asc')
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
            'kode_bidang' => 'required',
            'nama' => 'required',
            'mode' => 'required',
        ]);

        if ($request->mode == 'create') {
            $insert = new Bidang();
            $insert->kode_bidang = $request->kode_bidang;
            $insert->kode_gabung = $request->kode_bidang;
            $insert->nama = $request->nama;
            $insert->save();
            
        } else if ($request->mode == 'update') {
            $update = Bidang::where('kode_gabung', $request->kode_gabung)->firstOrFail();
            $update->kode_bidang = $request->kode_bidang;
            $update->kode_gabung = $request->kode_bidang;
            $update->nama = $request->nama;
            $update->save();
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
            'message' => 'Data disimpan',
        ]);
    }

    public function remove(Request $request, $kdBidang)
    {
        $kdGabung = $kdBidang;

        $kec = Bidang::where('kode_gabung', $kdGabung)
            ->firstOrFail();

        $kec->delete();

        return response()->json([
            'message' => 'Data dihapus',
            'data' => $kec,
        ]);
    }
}
