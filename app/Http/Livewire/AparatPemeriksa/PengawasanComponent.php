<?php

namespace App\Http\Livewire\Aparatpemeriksa;

use App\Models\AparatPemeriksa;
use App\Models\EksposePengawasan;
use App\Models\FilePengawasan;
use App\Models\JenisPengawasan;
use App\Models\KriteriaPengawasan;
use App\Models\Pengawasan;
use App\Models\PermindokPengawasan;
use App\Models\ReferensiUnit;
use App\Models\RequestPengawasanUnit;
use App\Models\UndanganPengawasan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PengawasanComponent extends Component
{
    // Load addon trait
    use WithPagination, WithFileUploads;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0, $isOpenMeeting = 0, $isOpenPermindok = 0, $isOpenEkspose = 0, $isOpenKriteria = 0,
        $isOpenHasil = 0, $isOpenUnit = 0, $isOpenUndangan = 0;
    public $isDetail = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_jenis, $input_kegiatan, $input_tahun, $input_aparat;
    public $input_jangka_waktu, $input_st, $input_kontak;
    public $input_nd, $input_pelaksanaan, $input_peserta, $entry_type;
    public $input_deadline_permindok, $input_surat_permindok, $input_nd_permindok;
    public $input_tanggal_ekspose, $input_surat_ekspose, $input_und_ekspose;
    public $input_deadline_kriteria, $input_surat_kriteria, $input_nd_kriteria, $input_type_kriteria;
    public $input_tanggapan_kriteria, $input_tanggal_kriteria;
    public $input_nomor_undangan, $input_type_undangan;
    public $input_unit_req, $input_keterangan_req, $input_status_req, $input_type_req, $parent_id;
    public $data_id;
    public $showPermindok, $showEkspose, $showKriteria, $showHasil;
    public $photos = [];

    // View
    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.aparatpemeriksa.pengawasan-component', [
            // Lists
            'loggedUser' => Auth::user(),
            'listJenisPengawasan' => JenisPengawasan::all(),
            'listAparatPemeriksa' => AparatPemeriksa::all(),
            'listUnit' => ReferensiUnit::select('es2')->distinct()->get(),
            'selectedData' => Pengawasan::where('id', $this->input_id)->first(),
            'lists' => Pengawasan::when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['kegiatan', 'like', '%' . $searchData . '%']
                ]);
            })->paginate($this->paginatedPerPages),
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_kegiatan', 'input_tahun', 'input_jenis', 'input_aparat',
            'input_jangka_waktu', 'input_st', 'input_kontak',
            'input_deadline_permindok', 'input_surat_permindok', 'input_nd_permindok',
            'input_tanggal_ekspose', 'input_surat_ekspose', 'input_und_ekspose',
            'input_deadline_kriteria', 'input_surat_kriteria', 'input_nd_kriteria',
            'input_tanggapan_kriteria', 'input_tanggal_kriteria',
            'input_unit_req', 'input_keterangan_req', 'input_status_req', 'input_type_req',
            'input_nomor_undangan', 'input_type_undangan',
            'parent_id', 'data_id'
        ]);
    }

    public function showMenu($menu)
    {
        $this->showPermindok = $menu == 'permindok' ? !$this->showPermindok : $this->showPermindok;
        $this->showEkspose = $menu == 'ekspose' ? !$this->showEkspose : $this->showEkspose;
        $this->showKriteria = $menu == 'kriteria' ? !$this->showKriteria : $this->showKriteria;
        $this->showHasil = $menu == 'hasil' ? !$this->showHasil : $this->showHasil;
    }

    // Open input form
    public function openModal()
    {
        $this->isOpen = true;
        $this->isDetail = false;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = false;
    }

    // Open input form
    public function openMeeting($data, $type)
    {
        $this->input_id = $data['id'];

        $this->isOpen = false;
        $this->isDetail = false;
        $this->isOpenMeeting = true;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = false;

        $this->entry_type = $type;
        $this->input_nd = $type == 'entry' ? $data['nd_entry'] : $data['nd_exit'];
        $this->input_peserta = $type == 'entry' ? $data['peserta_entry'] : $data['peserta_exit'];
        $this->input_pelaksanaan = $type == 'entry' ? $data['tanggal_entry'] : $data['tanggal_exit'];
    }

    // Open input form
    public function openPermindok($id = null)
    {
        $this->data_id = $id;

        $data = PermindokPengawasan::where('id', $id)->first();

        $this->isOpen = false;
        $this->isDetail = false;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = true;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = false;

        $this->input_surat_permindok = $data->surat ?? null;
        $this->input_nd_permindok = $data->nd ?? null;
        $this->input_deadline_permindok = $data->deadline ?? null;
    }

    // Open input form
    public function openEkspose($id = null)
    {
        $this->data_id = $id;

        $data = EksposePengawasan::where('id', $id)->first();

        $this->isOpen = false;
        $this->isDetail = false;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = true;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = false;

        $this->input_surat_ekspose = $data->surat ?? null;
        $this->input_und_ekspose = $data->und ?? null;
        $this->input_tanggal_ekspose = $data->tanggal ?? null;
    }

    // Open input form
    public function openKriteria($type, $id = null)
    {
        $this->data_id = $id;

        $data = KriteriaPengawasan::where('id', $id)->first();

        $this->isOpen = false;
        $this->isDetail = false;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = $type == 'D1' ? true : false;
        $this->isOpenHasil = $type == 'D2' ? true : false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = false;

        $this->input_surat_kriteria = $data->surat ?? null;
        $this->input_nd_kriteria = $data->nd ?? null;
        $this->input_tanggapan_kriteria = $data->tanggapan ?? null;
        $this->input_tanggal_kriteria = $data->tanggal_tanggapan ?? null;
        $this->input_deadline_kriteria = $data->deadline ?? null;
        $this->input_type_kriteria = $data->type ?? $type;
    }

    // Open input form
    public function openUndangan($type, $parentId, $id = null)
    {
        $this->data_id = $id;
        $this->parent_id = $parentId;
        $this->input_type_undangan = $type;

        $data = UndanganPengawasan::where('id', $id)->first();

        $this->isOpen = false;
        $this->isDetail = false;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = true;

        $this->input_nomor_undangan = $data->und ?? null;
        $this->input_type_undangan = $data->type ?? $type;
    }

    // Open input form
    public function openUnit($type, $parentId, $id = null)
    {
        $this->data_id = $id;
        $this->parent_id = $parentId;
        $this->input_type_req = $type;

        $data = RequestPengawasanUnit::where('id', $id)->first();

        $this->isOpen = false;
        $this->isDetail = false;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = true;
        $this->isOpenUndangan = false;

        $this->input_unit_req = $data->unit ?? null;
        $this->input_keterangan_req = $data->keterangan ?? null;
        $this->input_status_req = $data->status ?? null;
    }

    // Open input form
    public function openDetail($id)
    {
        $this->input_id = $id;

        $this->isOpen = false;
        $this->isDetail = true;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = false;
    }

    // Close input form
    public function closeModal()
    {
        $this->isOpen = false;
        $this->isDetail = false;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = false;

        $this->resetInputFields();
    }

    // Close input form
    public function closeModalInput()
    {
        $this->isOpen = false;
        $this->isDetail = true;
        $this->isOpenMeeting = false;
        $this->isOpenPermindok = false;
        $this->isOpenEkspose = false;
        $this->isOpenKriteria = false;
        $this->isOpenHasil = false;
        $this->isOpenUnit = false;
        $this->isOpenUndangan = false;

        $this->resetInputFields();
    }

    // Open input form and then reset input fields
    public function create()
    {
        $this->openModal();
    }

    // Save data
    public function store()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_kegiatan' => 'required|string',
            'input_jenis' => 'required',
            'input_aparat' => 'required',
            'input_tahun' => 'required|string',
            'input_st' => 'required',
            'input_jangka_waktu' => 'required',
        ], $messages);

        // Insert or Update if Ok
        $data = Pengawasan::updateOrCreate(['id' => $this->input_id], [
            'kegiatan' => $this->input_kegiatan,
            'tahun' => $this->input_tahun,
            'jenis' => $this->input_jenis,
            'aparat' => $this->input_aparat,
            'kontak' => $this->input_kontak,
            'st' => $this->input_st,
            'jangka_waktu' => $this->input_jangka_waktu,
            'created_by' => Auth::id(),
        ]);

        $id = (!$this->input_id) ? $data->id : $this->input_id;

        foreach ($this->photos as $photo) {
            $fileName = time() . '_' . $id . '_' . strtolower(preg_replace('/\s+/', '_', $photo->getClientOriginalName()));
            $photo->storeAs('pengawasan', $fileName);

            FilePengawasan::create([
                'pengawasan' => $id,
                'name' => $fileName,
                'type' => 'PR',
                'created_by' => Auth::id(),
                'file' => env('APP_URL') . '/file/pengawasan/' . $fileName,
            ]);
        }

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        $this->closeModal();
    }

    // Save data
    public function storeMeeting()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_nd' => 'required|string',
            'input_peserta' => 'required',
            'input_pelaksanaan' => 'required',
        ], $messages);

        // Insert or Update if Ok
        if ($this->entry_type == 'entry')
            $data = Pengawasan::where('id', $this->input_id)
                ->update([
                    'nd_entry' => $this->input_nd,
                    'tanggal_entry' => $this->input_pelaksanaan,
                    'peserta_entry' => $this->input_peserta,
                ]);
        else {
            $data = Pengawasan::where('id', $this->input_id)
                ->update([
                    'nd_exit' => $this->input_nd,
                    'tanggal_exit' => $this->input_pelaksanaan,
                    'peserta_exit' => $this->input_peserta,
                ]);
        }

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        $this->closeModalInput();
    }

    public function storePermindok()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_nd_permindok' => 'required|string',
            'input_deadline_permindok' => 'required',
            'input_surat_permindok' => 'required',
        ], $messages);

        // Insert or Update if Ok
        $data = PermindokPengawasan::updateOrCreate(['id' => $this->data_id], [
            'pengawasan' => $this->input_id,
            'surat' => $this->input_surat_permindok,
            'nd' => $this->input_nd_permindok,
            'deadline' => $this->input_deadline_permindok,
            'created_by' => Auth::id(),
        ]);

        // Show an alert
        $this->alert('success', 'Data berhasil disimpan');

        $this->closeModalInput();
    }

    public function storeEkspose()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_und_ekspose' => 'required|string',
            'input_tanggal_ekspose' => 'required',
            'input_surat_ekspose' => 'required',
        ], $messages);

        // Insert or Update if Ok
        $data = EksposePengawasan::updateOrCreate(['id' => $this->data_id], [
            'pengawasan' => $this->input_id,
            'surat' => $this->input_surat_ekspose,
            'und' => $this->input_und_ekspose,
            'tanggal' => $this->input_tanggal_ekspose,
            'created_by' => Auth::id(),
        ]);

        // Show an alert
        $this->alert('success', 'Data berhasil disimpan');

        $this->closeModalInput();
    }

    public function storeKriteria()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_nd_kriteria' => 'required|string',
            'input_deadline_kriteria' => 'required',
            'input_surat_kriteria' => 'required',
        ], $messages);

        // Insert or Update if Ok
        $data = KriteriaPengawasan::updateOrCreate(['id' => $this->data_id], [
            'pengawasan' => $this->input_id,
            'surat' => $this->input_surat_kriteria,
            'nd' => $this->input_nd_kriteria,
            'deadline' => $this->input_deadline_kriteria,
            'type' => $this->input_type_kriteria,
            'tanggapan' => $this->input_tanggapan_kriteria,
            'tanggal_tanggapan' => $this->input_tanggal_kriteria,
            'created_by' => Auth::id(),
        ]);

        $id = (!$this->data_id) ? $data->id : $this->data_id;

        foreach ($this->photos as $photo) {
            $fileName = time() . '_' . $id . '_' . strtolower(preg_replace('/\s+/', '_', $photo->getClientOriginalName()));
            $photo->storeAs('pengawasan', $fileName);

            FilePengawasan::create([
                'pengawasan' => $id,
                'name' => $fileName,
                'type' => $this->input_type_kriteria,
                'unit' => '-',
                'created_by' => Auth::id(),
                'file' => env('APP_URL') . '/file/pengawasan/' . $fileName,
            ]);
        }

        // Show an alert
        $this->alert('success', 'Data berhasil disimpan');

        $this->closeModalInput();
    }

    public function storeUndangan()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_nomor_undangan' => 'required|string',
            'input_type_undangan' => 'required',
        ], $messages);

        // Insert or Update if Ok
        $data = UndanganPengawasan::updateOrCreate(['id' => $this->data_id], [
            'pengawasan' => $this->parent_id,
            'und' => $this->input_nomor_undangan,
            'type' => $this->input_type_undangan,
            'created_by' => Auth::id(),
        ]);

        // Show an alert
        $this->alert('success', 'Data berhasil disimpan');

        $this->closeModalInput();
    }

    public function storeUnit()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_unit_req' => 'required|string',
            'input_keterangan_req' => 'required',
            'input_status_req' => 'required',
        ], $messages);

        // Insert or Update if Ok
        $data = RequestPengawasanUnit::updateOrCreate(['id' => $this->data_id], [
            'pengawasan' => $this->parent_id,
            'status' => $this->input_status_req,
            'unit' => $this->input_unit_req,
            'keterangan' => $this->input_keterangan_req,
            'type' => $this->input_type_req,
            'created_by' => Auth::id(),
        ]);

        $id = (!$this->data_id) ? $data->id : $this->data_id;

        foreach ($this->photos as $photo) {
            $fileName = time() . '_' . $id . '_' . strtolower(preg_replace('/\s+/', '_', $photo->getClientOriginalName()));
            $photo->storeAs('pengawasan', $fileName);

            FilePengawasan::create([
                'pengawasan' => $id,
                'name' => $fileName,
                'type' => $this->input_type_req,
                'unit' => $this->input_unit_req,
                'created_by' => Auth::id(),
                'file' => env('APP_URL') . '/file/pengawasan/' . $fileName,
            ]);
        }

        // Show an alert
        $this->alert('success', 'Data berhasil disimpan');

        $this->closeModalInput();
    }

    // Parse data to input form
    public function edit($id)
    {
        // Find data from the $id
        $data = Pengawasan::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_kegiatan = $data->kegiatan;
        $this->input_tahun = $data->tahun;
        $this->input_jenis = $data->jenis;
        $this->input_aparat = $data->aparat;
        $this->input_st = $data->st;
        $this->input_kontak = $data->kontak;
        $this->input_jangka_waktu = $data->jangka_waktu;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = Pengawasan::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }

    // Delete File
    public function deleteFile($id)
    {
        // Find existing photo
        $sql = FilePengawasan::select('file')->where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Then delete it
        unlink(storage_path('app/pengawasan/' . substr(str_replace(env('APP_URL') . '/file/pengawasan', "", $sql->file), 1)));

        // Show an alert
        $this->alert('warning', 'File berhasil dihapus');
    }
}
