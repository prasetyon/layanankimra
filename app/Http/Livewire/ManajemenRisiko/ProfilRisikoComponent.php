<?php

namespace App\Http\Livewire\ManajemenRisiko;

use App\Models\ProfilRisiko;
use App\Models\ReferensiUnit;
use App\Models\SasaranOrganisasi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProfilRisikoComponent extends Component
{
    // Load addon trait
    use WithPagination;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_kejadian;
    public $input_so, $input_penyebab, $input_dampak;
    public $input_kategori, $input_sistem, $input_lk_kemungkinan, $input_unit;
    public $input_penjelasan_kemungkinan, $input_ld_dampak, $input_tahun;
    public $input_penjelasan_dampak, $input_besaran_risiko, $input_lr;
    public $input_prioritas_risiko, $input_lk_risiko, $input_ld_risiko, $input_lr_risiko;
    public $input_keputusan_mitigasi, $input_nama_iru, $input_batasan_nilai;

    // View
    public function render()
    {
        $searchData = $this->searchTerm;

        $user = Auth::user();
        $userid = $user->id;

        return view('livewire.manajemen-risiko.profil-risiko-component', [
            // Lists
            'listUnit' => ReferensiUnit::select('es2')->distinct()->get(),
            'listSO' => SasaranOrganisasi::all(),
            'lists' => ProfilRisiko::when($user->role == 'user', function ($searchById) use ($userid) {
                $searchById->where([
                    ['created_by', $userid]
                ]);
            })->when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['kejadian', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['unit', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['tahun', 'like', '%' . $searchData . '%'],
                ]);
            })->paginate($this->paginatedPerPages),
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_id', 'input_kejadian', 'input_so', 'input_penyebab', 'input_tahun',
            'input_dampak', 'input_kategori', 'input_sistem', 'input_lk_kemungkinan',
            'input_unit', 'input_penjelasan_kemungkinan', 'input_ld_dampak',
            'input_penjelasan_dampak', 'input_besaran_risiko', 'input_lr',
            'input_prioritas_risiko', 'input_lk_risiko', 'input_ld_risiko', 'input_lr_risiko',
            'input_keputusan_mitigasi', 'input_nama_iru', 'input_batasan_nilai',
        ]);
    }

    // Open input form
    public function openModal()
    {
        $this->isOpen = true;
    }

    // Close input form
    public function closeModal()
    {
        $this->isOpen = false;
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
            'input_kejadian' => 'required|string',
        ], $messages);

        // Insert or Update if Ok
        if (isset($this->input_id)) {
            ProfilRisiko::where(['id' => $this->input_id])
                ->update([
                    'kejadian' => $this->input_kejadian,
                    'so' => $this->input_so,
                    'penyebab' => $this->input_penyebab,
                    'dampak' => $this->input_dampak,
                    'kategori' => $this->input_kategori,
                    'sistem' => $this->input_sistem,
                    'lk_kemungkinan' => $this->input_lk_kemungkinan,
                    'penjelasan_kemungkinan' => $this->input_penjelasan_kemungkinan,
                    'ld_dampak' => $this->input_ld_dampak,
                    'penjelasan_dampak' => $this->input_penjelasan_dampak,
                    'besaran_risiko' => $this->input_besaran_risiko,
                    'lr' => $this->input_lr,
                    'prioritas_risiko' => $this->input_prioritas_risiko,
                    'lk_risiko' => $this->input_lk_risiko,
                    'ld_risiko' => $this->input_ld_risiko,
                    'lr_risiko' => $this->input_lr_risiko,
                    'keputusan_mitigasi' => $this->input_keputusan_mitigasi,
                    'nama_iru' => $this->input_nama_iru,
                    'batasan_nilai' => $this->input_batasan_nilai,
                    'tahun' => $this->input_tahun,
                    'unit' => $this->input_unit,
                ]);
        } else {
            ProfilRisiko::create([
                'id' => $this->input_id,
                'kejadian' => $this->input_kejadian,
                'so' => $this->input_so,
                'penyebab' => $this->input_penyebab,
                'dampak' => $this->input_dampak,
                'kategori' => $this->input_kategori,
                'sistem' => $this->input_sistem,
                'lk_kemungkinan' => $this->input_lk_kemungkinan,
                'penjelasan_kemungkinan' => $this->input_penjelasan_kemungkinan,
                'ld_dampak' => $this->input_ld_dampak,
                'penjelasan_dampak' => $this->input_penjelasan_dampak,
                'besaran_risiko' => $this->input_besaran_risiko,
                'lr' => $this->input_lr,
                'prioritas_risiko' => $this->input_prioritas_risiko,
                'lk_risiko' => $this->input_lk_risiko,
                'ld_risiko' => $this->input_ld_risiko,
                'lr_risiko' => $this->input_lr_risiko,
                'keputusan_mitigasi' => $this->input_keputusan_mitigasi,
                'nama_iru' => $this->input_nama_iru,
                'batasan_nilai' => $this->input_batasan_nilai,
                'tahun' => $this->input_tahun,
                'unit' => $this->input_unit,
                'created_by' => Auth::id(),
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
        $data = ProfilRisiko::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_kejadian = $data->kejadian;
        $this->input_so = $data->so;
        $this->input_penyebab = $data->penyebab;
        $this->input_dampak = $data->dampak;
        $this->input_kategori = $data->kategori;
        $this->input_sistem = $data->sistem;
        $this->input_lk_kemungkinan = $data->lk_kemungkinan;
        $this->input_penjelasan_kemungkinan = $data->penjelasan_kemungkinan;
        $this->input_ld_dampak = $data->ld_dampak;
        $this->input_penjelasan_dampak = $data->penjelasan_dampak;
        $this->input_besaran_risiko = $data->besaran_risiko;
        $this->input_lr = $data->lr;
        $this->input_prioritas_risiko = $data->prioritas_risiko;
        $this->input_lk_risiko = $data->lk_risiko;
        $this->input_ld_risiko = $data->ld_risiko;
        $this->input_lr_risiko = $data->lr_risiko;
        $this->input_keputusan_mitigasi = $data->keputusan_mitigasi;
        $this->input_nama_iru = $data->nama_iru;
        $this->input_batasan_nilai = $data->batasan_nilai;
        $this->input_tahun = $data->tahun;
        $this->input_unit = $data->unit;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = ProfilRisiko::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
