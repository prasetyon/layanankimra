<?php

namespace Database\Seeders;

use App\Models\ReferensiUnit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReferensiUnit::truncate();
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Tenaga Pengkaji Bidang PNBP',
            'es3' => ''
        ]);

        // Set DJA
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Sekretariat Direktorat Jenderal Anggaran',
            'es3' => 'Bagian Organisasi dan Tata Laksana'
        ]);

        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Sekretariat Direktorat Jenderal Anggaran',
            'es3' => 'Bagian Kepatuhan Internal, Manajemen Risiko, dan Advokasi'
        ]);

        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Sekretariat Direktorat Jenderal Anggaran',
            'es3' => 'Bagian Sumber Daya Manusia'
        ]);

        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Sekretariat Direktorat Jenderal Anggaran',
            'es3' => 'Bagian Perencanaan dan Keuangan'
        ]);

        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Sekretariat Direktorat Jenderal Anggaran',
            'es3' => 'Bagian Umum'
        ]);

        // PAPBN
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penyusunan Anggaran Pendapatan dan Belanja Negara',
            'es3' => 'Subdirektorat Analisis Ekonomi Makro dan Pendapatan Negara'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penyusunan Anggaran Pendapatan dan Belanja Negara',
            'es3' => 'Subdirektorat Penyusunan Anggaran Belanja Negara I'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penyusunan Anggaran Pendapatan dan Belanja Negara',
            'es3' => 'Subdirektorat Penyusunan Anggaran Belanja Negara II'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penyusunan Anggaran Pendapatan dan Belanja Negara',
            'es3' => 'Subdirektorat Penyusunan Anggaran Belanja Negara III'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penyusunan Anggaran Pendapatan dan Belanja Negara',
            'es3' => 'Subdirektorat Penyusunan Pembiayaan Anggaran dan Penganggaran Risiko Fiskal'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penyusunan Anggaran Pendapatan dan Belanja Negara',
            'es3' => 'Subdirektorat Daduktek Anggaran Pendapatan dan Belanja Negara'
        ]);

        // A1
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Perekonomian dan Kemaritiman',
            'es3' => 'Subdirektorat Anggaran Bidang Pertanian, Kelautan, dan Kehutanan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Perekonomian dan Kemaritiman',
            'es3' => 'Subdirektorat Anggaran Bidang Pekerjaan Umum, Agraria, dan Tata Ruang'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Perekonomian dan Kemaritiman',
            'es3' => 'Subdirektorat Anggaran Bidang Perhubungan, Kepariwisataan, dan Koperasi dan UMKM'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Perekonomian dan Kemaritiman',
            'es3' => 'Subdirektorat Anggaran Bidang Keuangan dan Ketenagakerjaan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Perekonomian dan Kemaritiman',
            'es3' => 'Subdirektorat Anggaran Bidang Energi, Perindustrian, dan Perdagangan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Perekonomian dan Kemaritiman',
            'es3' => 'Subdirektorat Daduktek Anggaran Bidang Perekonomian dan Kemaritiman'
        ]);

        // A2
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Pembangunan Manusia dan Kebudayaan',
            'es3' => 'Subdirektorat Anggaran Bidang Pendidikan dan Kepemudaan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Pembangunan Manusia dan Kebudayaan',
            'es3' => 'Subdirektorat Anggaran Bidang Kesejahteraan Sosial dan Kepresidenan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Pembangunan Manusia dan Kebudayaan',
            'es3' => 'Subdirektorat Anggaran Bidang Agama dan Lembaga Tinggi Negara'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Pembangunan Manusia dan Kebudayaan',
            'es3' => 'Subdirektorat Anggaran Bidang Riset, Teknologi, dan Pendidikan Tinggi'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Pembangunan Manusia dan Kebudayaan',
            'es3' => 'Subdirektorat Anggaran Bidang Kesehatan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Pembangunan Manusia dan Kebudayaan',
            'es3' => 'Subdirektorat Daduktek Anggaran Bidang Pembangunan Manusia dan Kebudayaan'
        ]);

        // A3
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Politik, Hukum, Pertahanan dan Keamanan, dan Bagian Anggaran Bendahara Umum Negara',
            'es3' => 'Subdirektorat Anggaran Bidang Politik'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Politik, Hukum, Pertahanan dan Keamanan, dan Bagian Anggaran Bendahara Umum Negara',
            'es3' => 'Subdirektorat Anggaran Bidang Hukum'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Politik, Hukum, Pertahanan dan Keamanan, dan Bagian Anggaran Bendahara Umum Negara',
            'es3' => 'Subdirektorat Anggaran Bidang Pertahanan dan Keamanan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Politik, Hukum, Pertahanan dan Keamanan, dan Bagian Anggaran Bendahara Umum Negara',
            'es3' => 'Subdirektorat Mitra Pembantu Pengguna Anggaran Bendahara Umum Negara'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Politik, Hukum, Pertahanan dan Keamanan, dan Bagian Anggaran Bendahara Umum Negara',
            'es3' => 'Subdirektorat Penyusunan Rencana Anggaran dan Laporan Keuangan bagian Anggaran BUN Pengelola BSLB'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Anggaran Bidang Politik, Hukum, Pertahanan dan Keamanan, dan Bagian Anggaran Bendahara Umum Negara',
            'es3' => 'Subdirektorat Daduktek Anggaran Bidang Politik, Hukum, Pertahanan dan Keamanan, dan Bagian Anggaran Bendahara Umum Negara'
        ]);

        // PNBP KND
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Sumber Daya Alam dan Kekayaan Negara Dipisahkan',
            'es3' => 'Subdirektorat Penerimaan Sumber Daya Alam Minyak dan Gas Bumi'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Sumber Daya Alam dan Kekayaan Negara Dipisahkan',
            'es3' => 'Subdirektorat Penerimaan Sumber Daya Alam Non Minyak dan Gas Bumi'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Sumber Daya Alam dan Kekayaan Negara Dipisahkan',
            'es3' => 'Subdirektorat Penerimaan Kekayaan Negara Dipisahkan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Sumber Daya Alam dan Kekayaan Negara Dipisahkan',
            'es3' => 'Subdirektorat Potensi dan Pengawasan Penerimaan Negara Bukan Pajak Sumber Daya Alam dan Kekayaan Negara Dipisahkan'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Sumber Daya Alam dan Kekayaan Negara Dipisahkan',
            'es3' => 'Subdirektorat Daduktek Penerimaan Negara Bukan Pajak Sumber Daya Alam dan Kekayaan Negara Dipisahkan'
        ]);

        // PNBP KL
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Kementerian / Lembaga',
            'es3' => 'Subdirektorat Potensi, Penerimaan, dan Pengawasan Kementerian Lembaga I'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Kementerian / Lembaga',
            'es3' => 'Subdirektorat Potensi, Penerimaan, dan Pengawasan Kementerian Lembaga II'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Kementerian / Lembaga',
            'es3' => 'Subdirektorat Potensi, Penerimaan, dan Pengawasan Kementerian Lembaga III'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Penerimaan Negara Bukan Pajak Kementerian / Lembaga',
            'es3' => 'Subdirektorat Daduktek Penerimaan Negara Bukan Pajak Kementerian / Lembaga'
        ]);

        // DSP
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Sistem Penganggaran',
            'es3' => 'Subdirektorat Transformasi Sistem Penganggaran'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Sistem Penganggaran',
            'es3' => 'Subdirektorat Standar Biaya'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Sistem Penganggaran',
            'es3' => 'Subdirektorat Evaluasi Kinerja Penganggaran'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Sistem Penganggaran',
            'es3' => 'Subdirektorat Teknologi Informasi Penganggaran'
        ]);

        // HPP
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Harmonisasi Peraturan dan Penganggaran',
            'es3' => 'Subdirektorat Harmonisasi Peraturan Penganggaran Kementerian / Lembaga I'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Harmonisasi Peraturan dan Penganggaran',
            'es3' => 'Subdirektorat Harmonisasi Peraturan Penganggaran Kementerian / Lembaga II'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Harmonisasi Peraturan dan Penganggaran',
            'es3' => 'Subdirektorat Harmonisasi Peraturan Jaminan Sosial'
        ]);
        ReferensiUnit::insert([
            'kl' => 'Kementerian Keuangan',
            'es1' => 'Direktorat Jenderal Anggaran',
            'es2' => 'Direktorat Harmonisasi Peraturan dan Penganggaran',
            'es3' => 'Subdirektorat Harmonisasi Penganggaran Remunerasi'
        ]);
    }
}
