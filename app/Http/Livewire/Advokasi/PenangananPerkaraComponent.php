<?php

namespace App\Http\Livewire\Advokasi;

use App\Models\FilePerkara;
use App\Models\FileSidangPerkara;
use App\Models\JenisPerkara;
use App\Models\JenisSidang;
use App\Models\PerkaraAdvokasi;
use App\Models\ReferensiUnit;
use App\Models\SidangPerkara;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class PenangananPerkaraComponent extends Component
{
    // Load addon trait
    use WithPagination, WithFileUploads;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $isKajianHukum = 0;
    public $isSidang = 0;
    public $isTimeline = 0;
    public $paginatedPerPages = 5;
    public $noSurat, $domisili, $posisiDJA, $perihalPerkara, $pihakPenggugat, $pihakTergugat, $type;
    public $tahunMasuk, $unit, $noSuratKuasa, $khusus, $wilayah, $objekTuntutan, $objekTuntutanLainnya;
    public $noST, $tanggalSidang, $susunanMajelis, $agendaSidang, $keteranganSidang, $jenisSidang;
    public $photos = [];
    public $listFile, $listFileSidang;
    public $input_id, $searchTerm, $input_detail, $input_name, $input_file, $user, $perkara_id;

    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.advokasi.penanganan-perkara-component', [
            'loggedUser' => Auth::user(),
            'listTypes' => JenisPerkara::where('type', 'litigasi')->get(),
            'listSidang' => JenisSidang::all(),
            'timeline' => SidangPerkara::where('perkara', $this->perkara_id)->orderBy('tanggal', 'desc')->get(),
            'listUnits' => ReferensiUnit::select('es2')->distinct()->get(),
            'lists' => PerkaraAdvokasi::where('modul', 1)
                ->when($searchData, function ($searchQuery) use ($searchData) {
                    $searchQuery->where([
                        ['nomor_perkara', 'like', '%' . $searchData . '%']
                    ])->orWhere([
                        ['pokok_perkara', 'like', '%' . $searchData . '%'],
                    ])->orWhere([
                        ['penggugat', 'like', '%' . $searchData . '%'],
                    ])->orWhere([
                        ['tergugat', 'like', '%' . $searchData . '%'],
                    ])->orWhere([
                        ['objek_tuntutan', 'like', '%' . $searchData . '%'],
                    ]);
                })->paginate($this->paginatedPerPages)
        ]);
    }
    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'noSurat', 'domisili', 'posisiDJA',
            'perihalPerkara', 'pihakPenggugat', 'pihakTergugat',
            'type', 'tahunMasuk', 'unit', 'noSuratKuasa', 'khusus',
            'wilayah', 'objekTuntutan', 'objekTuntutanLainnya',
            'noST', 'tanggalSidang', 'susunanMajelis',
            'agendaSidang', 'keteranganSidang', 'input_id'
        ]);
    }

    // Open input form
    public function openModal()
    {
        $this->isOpen = true;
        $this->isSidang = false;
        $this->isTimeline = false;
    }

    public function openSidang($id)
    {
        $this->perkara_id = $id;
        $this->isSidang = true;
        $this->isOpen = false;
        $this->isTimeline = false;
    }

    public function openTimeline($id)
    {
        $this->perkara_id = $id;
        $this->isTimeline = true;
        $this->isSidang = false;
        $this->isOpen = false;
    }

    // Close input form
    public function closeModal()
    {
        $this->isOpen = false;
        $this->isSidang = false;
        $this->isTimeline = false;

        // Reset input fields for next input
        $this->resetInputFields();
    }

    // Open input form and then reset input fields
    public function create()
    {
        $this->openModal();
        $this->resetInputFields();
    }

    // Approve data
    public function approve($id)
    {
        $user = Auth::user();
        if (in_array($user->role, ['admin', 'superuser'])) PerkaraAdvokasi::where('id', $id)->update(['approved' => 1]);
        else if ($user->role == 'es4') PerkaraAdvokasi::where('id', $id)->update(['approved_es4' => 1]);
        else if ($user->role == 'es3') PerkaraAdvokasi::where('id', $id)->update(['approved_es3' => 1]);
        else if ($user->role == 'es2') PerkaraAdvokasi::where('id', $id)->update(['approved_es2' => 1]);

        // Show an alert
        $this->alert('success', 'Data berhasil diapprove');
    }

    // Save data
    public function storeSidang()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
            '*.file' => 'This column must be a file',
            '*.max:2048' => 'File can not be more than 2.048 kb',
        ];

        $this->validate([
            'noST' => 'required',
            'tanggalSidang' => 'required',
        ], $messages);

        // Insert or Update if Ok
        $data = SidangPerkara::updateOrCreate(['id' => $this->input_id], [
            'nomor_st' => $this->noST,
            'perkara' => $this->perkara_id,
            'tanggal' => $this->tanggalSidang,
            'agenda' => $this->agendaSidang,
            'keterangan' => $this->keteranganSidang,
            'majelis' => $this->susunanMajelis,
            'type' => $this->jenisSidang,
            'created_by' => Auth::id(),
        ]);

        $id = $data->id;

        foreach ($this->photos as $photo) {
            $fileName = time() . '_' . $id . '_' . strtolower(preg_replace('/\s+/', '_', $photo->getClientOriginalName()));
            $photo->storeAs('advokasi', $fileName);

            FileSidangPerkara::insert([
                'sidang' => $id,
                'name' => $fileName,
                'created_by' => Auth::id(),
                'file' => env('APP_URL') . '/file/advokasi/' . $fileName,
            ]);
        }

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        // Close input form, we're going back to the list
        $this->closeModal();
    }

    // Save data
    public function store()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
            '*.file' => 'This column must be a file',
            '*.max:2048' => 'File can not be more than 2.048 kb',
        ];

        $this->validate([
            'noSurat' => 'required',
            'domisili' => 'required',
            'posisiDJA' => 'required',
            'perihalPerkara' => 'required',
            'pihakPenggugat' => 'required',
            'pihakTergugat' => 'required',
            'photos.*' => 'file|max:2048',
        ], $messages);

        // Insert or Update if Ok
        $data = PerkaraAdvokasi::updateOrCreate(['id' => $this->input_id], [
            'nomor_perkara' => $this->noSurat,
            'modul' => 1,
            'domisili' => $this->domisili,
            'type' => $this->type,
            'penggugat' => $this->pihakPenggugat,
            'tergugat' => $this->pihakTergugat,
            'pokok_perkara' => $this->perihalPerkara,
            'posisi_dja' => $this->posisiDJA,
            'created_by' => Auth::id() ?? 1,
            'tahun_masuk' => $this->tahunMasuk,
            'unit' => $this->unit,
            'nomor_surat_kuasa' => $this->noSuratKuasa,
            'khusus' => $this->khusus,
            'wilayah' => $this->wilayah,
            'objek_tuntutan' => $this->objekTuntutan,
        ]);

        $id = (!$this->input_id) ? $data->id : $this->input_id;

        foreach ($this->photos as $photo) {
            $fileName = time() . '_' . $id . '_' . strtolower(preg_replace('/\s+/', '_', $photo->getClientOriginalName()));
            $photo->storeAs('advokasi', $fileName);

            FilePerkara::insert([
                'perkara' => $id,
                'name' => $fileName,
                'created_by' => Auth::id(),
                'file' => env('APP_URL') . '/file/advokasi/' . $fileName,
            ]);
        }

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        // Close input form, we're going back to the list
        $this->closeModal();
    }

    // Parse data to input form
    public function edit($id)
    {
        // Find data from the $id
        $data = PerkaraAdvokasi::findOrFail($id);

        $this->input_id = $id;

        // Parse data from the $jenis variable
        $this->noSurat = $data->nomor_perkara;
        $this->domisili = $data->domisili;
        $this->type = $data->type;
        $this->pihakPenggugat = $data->penggugat;
        $this->pihakTergugat = $data->tergugat;
        $this->perihalPerkara = $data->pokok_perkara;
        $this->posisiDJA = $data->posisi_dja;
        $this->tahunMasuk = $data->tahun_masuk;
        $this->unit = $data->unit;
        $this->noSuratKuasa = $data->nomor_surat_kuasa;
        $this->khusus = $data->khusus;
        $this->wilayah = $data->wilayah;
        $this->objekTuntutan = $data->objek_tuntutan;
        $this->listFile = $data->file;

        // Then input fields and show data
        $this->openModal();
    }

    // Parse data to input form
    public function editSidang($id)
    {
        // Find data from the $id
        $data = SidangPerkara::findOrFail($id);

        $this->input_id = $id;

        // Parse data from the $jenis variable
        $this->noST = $data->nomor_st;
        $this->agendaSidang = $data->agenda;
        $this->tanggalSidang = $data->tanggal;
        $this->keteranganSidang = $data->keterangan;
        $this->susunanMajelis = $data->majelis;
        $this->perkara_id = $data->perkara;
        $this->jenisSidang = $data->type;
        $this->listFileSidang = $data->file;

        // Then input fields and show data
        $this->openSidang($this->perkara_id);
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = PerkaraAdvokasi::where('id', $id)->firstOrFail();
        $sql->find($id)->delete();

        $file = FilePerkara::where('perkara', $id)->get();
        foreach ($file as $f) {
            unlink(storage_path('app/advokasi/' . substr(str_replace(env('APP_URL') . '/file/advokasi', "", $file->file), 1)));
        }
        $file = FilePerkara::where('perkara', $id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }

    // Delete data
    public function finish($id)
    {
        // Find existing photo
        $sql = PerkaraAdvokasi::where('id', $id)->update(["finished" => 1]);

        // Show an alert
        $this->alert('success', 'Berhasil set status data sebagai selesai');
    }

    public function deleteFile($id)
    {
        // Find existing photo
        $sql = FilePerkara::select('file')->where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Then delete it
        unlink(storage_path('app/advokasi/' . substr(str_replace(env('APP_URL') . '/file/advokasi', "", $sql->file), 1)));

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }

    public function deleteFileSidang($id)
    {
        // Find existing photo
        $sql = FileSidangPerkara::select('file')->where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Then delete it
        unlink(storage_path('app/advokasi/' . substr(str_replace(env('APP_URL') . '/file/advokasi', "", $sql->file), 1)));

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
