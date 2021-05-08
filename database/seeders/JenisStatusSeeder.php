<?php

namespace Database\Seeders;

use App\Models\AparatPemeriksa;
use App\Models\JenisAduan;
use App\Models\JenisPemeriksaan;
use App\Models\JenisPerkara;
use App\Models\JenisSidang;
use App\Models\StatusAksi;
use Illuminate\Database\Seeder;

class JenisStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPerkara::truncate();
        JenisPerkara::insert([
            'type' => 'Litigasi',
            'name' => 'Permohonan Uji Materi (Judicial Review)'
        ]);

        JenisPerkara::insert([
            'type' => 'Litigasi',
            'name' => 'Perkara Perdata'
        ]);

        JenisPerkara::insert([
            'type' => 'Litigasi',
            'name' => 'Perkara Tata Usaha Negara (PTUN)'
        ]);

        JenisPerkara::insert([
            'type' => 'Litigasi',
            'name' => 'Perkara Pidana pada Tahapan Penyelidikan'
        ]);

        JenisPerkara::insert([
            'type' => 'Litigasi',
            'name' => 'Pelayanan Bantuan Hukum Lainnya'
        ]);

        JenisPerkara::insert([
            'type' => 'Non Litigasi',
            'name' => 'Pemberian Pendapat Hukum (Legal Opinion)'
        ]);

        JenisPerkara::insert([
            'type' => 'Non Litigasi',
            'name' => 'Pertimbangan Hukum'
        ]);

        JenisPerkara::insert([
            'type' => 'Non Litigasi',
            'name' => 'Konsultasi Hukum'
        ]);

        JenisSidang::truncate();
        JenisSidang::insert([
            'name' => 'Perkara Tingkat Pertama'
        ]);

        JenisSidang::insert([
            'name' => 'Perkara Tingkat Banding'
        ]);

        JenisSidang::insert([
            'name' => 'Perkara Tingkat Kasasi'
        ]);

        JenisSidang::insert([
            'name' => 'Perkara Tingkat Peninjauan Kembali'
        ]);

        JenisAduan::truncate();
        JenisAduan::insert([
            'name' => 'Pengaduan'
        ]);

        JenisAduan::insert([
            'name' => 'Aspirasi'
        ]);

        JenisAduan::insert([
            'name' => 'Permintaan Informasi'
        ]);

        StatusAksi::truncate();
        StatusAksi::insert([
            'name' => 'Belum ditindaklanjuti'
        ]);
        StatusAksi::insert([
            'name' => 'Dalam proses'
        ]);
        StatusAksi::insert([
            'name' => 'Diusulkan Sesuai'
        ]);
        StatusAksi::insert([
            'name' => 'Ditetapkan sesuai'
        ]);

        JenisPemeriksaan::truncate();
        JenisPemeriksaan::insert([
            'name' => 'LKPP'
        ]);
        JenisPemeriksaan::insert([
            'name' => 'LKBUN'
        ]);
        JenisPemeriksaan::insert([
            'name' => 'PDTT'
        ]);
        JenisPemeriksaan::insert([
            'name' => 'Kinerja'
        ]);
        JenisPemeriksaan::insert([
            'name' => 'BA 015'
        ]);

        AparatPemeriksa::truncate();
        AparatPemeriksa::insert([
            'name' => 'BPK'
        ]);
        AparatPemeriksa::insert([
            'name' => 'Inspektorat Jenderal'
        ]);
        AparatPemeriksa::insert([
            'name' => 'BPKP'
        ]);
        AparatPemeriksa::insert([
            'name' => 'Aparat Pemeriksa Lainnya'
        ]);
    }
}
