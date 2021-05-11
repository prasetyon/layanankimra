<?php

namespace App\Http\Controllers;

use App\Models\FilePengaduan;
use App\Models\JenisAduan;
use App\Models\Pengaduan;
use App\Models\TanggapanPengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    //
    public function index()
    {
        $data['jenis'] = JenisAduan::all();
        return view('pengaduan')->with('data', $data);
    }

    public function store(Request $request)
    {
        $dataUser = User::create([
            'username' => $request->nik,
            'password' => bcrypt($request->nik),
            'name' => $request->name,
            'role' => 'user',
            'email' => $request->email,
            'nik' => $request->nik,
            'phone' => $request->phone,
        ]);

        $dataPengaduan = Pengaduan::create([
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'type' => $request->type,
            'kronologi' => $request->kronologi,
            'motif' => $request->motif,
            'lokasi' => $request->lokasi,
            'pihak' => $request->pihak,
            'status' => 'Diterima',
            'created_by' => $dataUser->id,
        ]);

        $dataSidang = TanggapanPengaduan::create([
            'aduan' => $dataPengaduan->id,
            'tanggapan' => "Perihal: " . $request->perihal . "\nTanggal Kejadian:  " . $request->tanggal . "\nPihak Terlibat: " . $request->pihak . "\nLokasi Kejadian: " . $request->lokasi . "\nKronologi Kejadian: " . $request->kronologi . "\nMotif Kejadian: " . $request->motif,
            'created_by' => $dataUser->id,
        ]);

        if (isset($request->file)) {
            foreach ($request->file as $f) {
                $fileName = time() . '_' . $dataSidang->id . '_' . strtolower(preg_replace('/\s+/', '_', $f->getClientOriginalName()));
                $f->storeAs('aduan', $fileName);

                FilePengaduan::insert([
                    'aduan' => $dataSidang->id,
                    'name' => $fileName,
                    'created_by' => $dataUser->id,
                    'file' => env('APP_URL') . '/file/aduan/' . $fileName,
                ]);
            }
        }

        return redirect()->back()->with('alert-success', "Aduan Anda kami terima, silahkan cek progress aduan Anda dengan login menggunakan username dan password NIK/NIP anda");
    }
}
