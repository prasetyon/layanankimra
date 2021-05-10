<?php

namespace App\Http\Controllers;

use App\Models\PendapatHukum;
use App\Models\SidangPerkara;
use Illuminate\Http\Request;
use stdClass;

class AdvokasiController extends Controller
{
    //
    public function kalender()
    {
        $dataLitigasi = SidangPerkara::all();
        $dataNonLitigasi = PendapatHukum::all();

        $data = [];

        foreach ($dataLitigasi as $d) {
            $dataTemp = new stdClass;
            $dataTemp->title = 'Sidang ' . $d->jenisSidang->name . ' ' . $d->nomor_st;
            $dataTemp->start = $d->tanggal;
            if ($d->modul == 1) {
                $dataTemp->backgroundColor = '#0073b7';
                $dataTemp->borderColor = '#0073b7';
            } else {
                $dataTemp->backgroundColor = '#f39c12';
                $dataTemp->borderColor = '#f39c12';
            }
            $dataTemp->allDay = true;

            $data[] = $dataTemp;
        }

        foreach ($dataNonLitigasi as $d) {
            $dataTemp = new stdClass;
            $dataTemp->title = 'Permintaan Bantuan Hukum ' . $d->unit;
            $dataTemp->start = $d->tanggal;
            $dataTemp->backgroundColor = '#00c0ef';
            $dataTemp->borderColor = '#00c0ef';
            $dataTemp->allDay = true;

            $data[] = $dataTemp;
        }

        // dd($data);

        return view('advokasi.kalenderkegiatan')->with('events', $data);
    }
}
