<?php

namespace App\Http\Controllers\Api\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Subbidang;
use Illuminate\Http\Request;

class SubbidangController extends Controller
{
    //

    public function index(Request $request, $kdBidang)
    {
        $datas = Subbidang::where('kode_bidang', $kdBidang)
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
            'kode_sub_bidang' => 'required',
            'nama' => 'required',
            'mode' => 'required',
        ]);

        $message = null;
        if ($request->mode == 'create') {
            $insert = new Subbidang();
            $insert->kode_bidang = $request->kode_bidang;
            $insert->kode_sub_bidang = $request->kode_sub_bidang;
            $insert->kode_gabung = $request->kode_bidang.".".$request->kode_sub_bidang;
            $insert->nama = $request->nama;
            $insert->save();
            $message = "Data ditambahkan";
        } else if ($request->mode == 'update') {
            $update = Subbidang::where('kode_gabung', $request->kode_gabung)->firstOrFail();
            $update->kode_sub_bidang = $request->kode_sub_bidang;
            $update->kode_gabung = $request->kode_bidang . "." . $request->kode_sub_bidang;
            $update->nama = $request->nama;
            $update->save();
            $message = "Data diupdate";
        }

        return response()->json([
            'message' => $message,
        ]);
    }

    public function remove(Request $request, $kdBidang, $kdSubbidang)
    {
        $kdGabung = $kdBidang.".".$kdSubbidang;

        $kec = Subbidang::where('kode_gabung', $kdGabung)
            ->firstOrFail();

        $kec->delete();

        return response()->json([
            'message' => 'Data dihapus',
            'data' => $kec,
        ]);
    }
}
