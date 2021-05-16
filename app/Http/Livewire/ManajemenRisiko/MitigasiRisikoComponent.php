<?php

namespace App\Http\Livewire\ManajemenRisiko;

use App\Models\MitigasiRisiko;
use App\Models\ReferensiUnit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MitigasiRisikoComponent extends Component
{
    // Load addon trait
    use WithPagination;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_kejadian;
    public $input_opsi, $input_rencana_aksi, $input_output;
    public $input_target, $input_kendala, $input_sumberdaya, $input_unit;
    public $input_jadwal, $input_penanggung_jawab, $input_tahun;

    // View
    public function render()
    {
        $searchData = $this->searchTerm;

        $user = Auth::user();
        $userid = $user->id;

        return view('livewire.manajemen-risiko.mitigasi-risiko-component', [
            // Lists
            'listUnit' => ReferensiUnit::select('es2')->distinct()->get(),
            'lists' => MitigasiRisiko::when($user->role == 'user', function ($searchById) use ($userid) {
                $searchById->where([
                    ['created_by', $userid]
                ]);
            })->when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['kejadian', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['penganggung_jawab', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['unit', 'like', '%' . $searchData . '%'],
                ]);
            })->paginate($this->paginatedPerPages),
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_id', 'input_kejadian', 'input_opsi', 'input_rencana_aksi',
            'input_output', 'input_target', 'input_kendala', 'input_sumberdaya',
            'input_unit', 'input_jadwal', 'input_penanggung_jawab', 'input_tahun'
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
    }

    // Open input form and then reset input fields
    public function create()
    {
        $this->openModal();
        $this->resetInputFields();
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
            MitigasiRisiko::where(['id' => $this->input_id])
                ->update([
                    'kejadian' => $this->input_kejadian,
                    'opsi' => $this->input_opsi,
                    'rencana_aksi' => $this->input_rencana_aksi,
                    'output' => $this->input_output,
                    'target' => $this->input_target,
                    'kendala' => $this->input_kendala,
                    'sumberdaya' => $this->input_sumberdaya,
                    'jadwal' => $this->input_jadwal,
                    'penanggung_jawab' => $this->input_penanggung_jawab,
                    'tahun' => $this->input_tahun,
                    'unit' => $this->input_unit,
                ]);
        } else {
            MitigasiRisiko::create([
                'id' => $this->input_id,
                'kejadian' => $this->input_kejadian,
                'opsi' => $this->input_opsi,
                'rencana_aksi' => $this->input_rencana_aksi,
                'output' => $this->input_output,
                'target' => $this->input_target,
                'kendala' => $this->input_kendala,
                'sumberdaya' => $this->input_sumberdaya,
                'jadwal' => $this->input_jadwal,
                'penanggung_jawab' => $this->input_penanggung_jawab,
                'tahun' => $this->input_tahun,
                'unit' => $this->input_unit,
                'created_by' => Auth::id(),
            ]);
        }

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        // Close input form, we're going back to the list
        $this->closeModal();

        // Reset input fields for next input
        $this->resetInputFields();
    }

    // Parse data to input form
    public function edit($id)
    {
        // Find data from the $id
        $data = MitigasiRisiko::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_kejadian = $data->kejadian;
        $this->input_opsi = $data->opsi;
        $this->input_rencana_aksi = $data->rencana_aksi;
        $this->input_output = $data->output;
        $this->input_target = $data->target;
        $this->input_kendala = $data->kendala;
        $this->input_sumberdaya = $data->sumberdaya;
        $this->input_jadwal = $data->jadwal;
        $this->input_penanggung_jawab = $data->penanggung_jawab;
        $this->input_tahun = $data->tahun;
        $this->input_unit = $data->unit;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = MitigasiRisiko::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
