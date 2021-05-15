<?php

namespace App\Http\Livewire\ManajemenRisiko;

use App\Models\PiagamRisiko;
use App\Models\ReferensiUnit;
use App\Models\Risiko;
use App\Models\SasaranOrganisasi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PiagamRisikoComponent extends Component
{
    // Load addon trait
    use WithPagination;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0, $isOpenDetail = 0, $isOpenRisiko = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_nomor, $input_mulai, $input_selesai;
    public $input_tahun, $input_unit;
    public $risiko_id, $input_so, $input_risiko, $input_iru, $input_deskripsi;
    public $input_formula, $input_batas_aman, $input_batas_atas, $input_batas_bawah;
    public $input_satuan, $input_jenis_periode, $input_jenis_lokasi, $input_polarisasi;
    public $input_penanggung_jawab, $input_penyedia_data, $input_sumber_data, $input_periode_pelaporan;
    public $input_q1, $input_q2, $input_q3, $input_q4;

    public function render()
    {
        $searchData = $this->searchTerm;

        $user = Auth::user();
        $userid = $user->id;

        return view('livewire.manajemen-risiko.piagam-risiko-component', [
            'selectedPiagam' => PiagamRisiko::where('id', $this->input_id)->first(),
            'listSO' => SasaranOrganisasi::all(),
            'listUnit' => ReferensiUnit::select('es2')->distinct()->get(),
            'lists' => PiagamRisiko::when($user->role == 'user', function ($searchById) use ($userid) {
                $searchById->where([
                    ['created_by', $userid]
                ]);
            })->when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['nomor', 'like', '%' . $searchData . '%']
                ])->orWhere([
                    ['tahun', 'like', '%' . $searchData . '%']
                ])->orWhere([
                    ['unit', 'like', '%' . $searchData . '%']
                ]);
            })->orderBy('tahun', 'desc')->paginate($this->paginatedPerPages)
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_nomor', 'input_mulai', 'input_selesai',
            'input_tahun', 'input_unit', 'input_so', 'input_risiko', 'input_iru', 'input_deskripsi',
            'input_formula', 'input_batas_aman', 'input_batas_atas', 'input_batas_bawah',
            'input_satuan', 'input_jenis_periode', 'input_jenis_lokasi', 'input_polarisasi',
            'input_penanggung_jawab', 'input_penyedia_data', 'input_sumber_data', 'input_periode_pelaporan',
            'input_q1', 'input_q2', 'input_q3', 'input_q4'
        ]);
    }

    // Open input form
    public function openModal()
    {
        $this->isOpen = true;
        $this->isOpenDetail = false;
        $this->isOpenRisiko = false;
    }

    // Open input form
    public function openDetail($id)
    {
        $this->input_id = $id;
        $this->isOpen = false;
        $this->isOpenDetail = true;
        $this->isOpenRisiko = false;
    }

    // Open input form
    public function openRisiko()
    {
        $this->isOpen = false;
        $this->isOpenDetail = false;
        $this->isOpenRisiko = true;
    }

    // Close input form
    public function closeModal()
    {
        $this->isOpen = false;
        $this->isOpenDetail = false;
        $this->isOpenRisiko = false;
        $this->resetInputFields();
        $this->reset(['input_id', 'risiko_id']);
    }

    // Close input form
    public function closeRisiko()
    {
        $this->isOpen = false;
        $this->isOpenDetail = true;
        $this->isOpenRisiko = false;
        $this->resetInputFields();
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
            'input_nomor' => 'required|string',
            'input_mulai' => 'required|date',
            'input_selesai' => 'required|date',
            'input_tahun' => 'required',
            'input_unit' => 'required',
        ], $messages);

        if (isset($this->input_id)) {
            PiagamRisiko::where('id', $this->input_id)
                ->update([
                    'nomor' => $this->input_nomor,
                    'mulai' => $this->input_mulai,
                    'selesai' => $this->input_selesai,
                    'tahun' => $this->input_tahun,
                    'unit' => $this->input_unit,
                ]);
        } else {
            PiagamRisiko::create([
                'nomor' => $this->input_nomor,
                'mulai' => $this->input_mulai,
                'selesai' => $this->input_selesai,
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

    // Save data
    public function storeRisiko()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_so' => 'required',
            'input_risiko' => 'required',
            'input_deskripsi' => 'required',
            'input_iru' => 'required',
            'input_formula' => 'required',
            'input_satuan' => 'required',
            'input_jenis_periode' => 'required',
            'input_jenis_lokasi' => 'required',
            'input_polarisasi' => 'required',
            'input_penanggung_jawab' => 'required',
            'input_penyedia_data' => 'required',
            'input_sumber_data' => 'required',
            'input_periode_pelaporan' => 'required',
            'input_q1' => 'required',
            'input_q2' => 'required',
            'input_q3' => 'required',
            'input_q4' => 'required',
        ], $messages);

        if (isset($this->risiko_id)) {
            Risiko::where('id', $this->risiko_id)
                ->update([
                    'so' => $this->input_so,
                    'nama' => $this->input_risiko,
                    'deskripsi' => $this->input_deskripsi,
                    'iru' => $this->input_iru,
                    'formula' => $this->input_formula,
                    'batas_aman' => $this->input_batas_aman,
                    'batas_atas' => $this->input_batas_atas,
                    'batas_bawah' => $this->input_batas_bawah,
                    'satuan' => $this->input_satuan,
                    'jenis_periode' => $this->input_jenis_periode,
                    'jenis_lokasi' => $this->input_jenis_lokasi,
                    'polarisasi' => $this->input_polarisasi,
                    'penanggung_jawab' => $this->input_penanggung_jawab,
                    'penyedia_data' => $this->input_penyedia_data,
                    'sumber_data' => $this->input_sumber_data,
                    'periode_pelaporan' => $this->input_periode_pelaporan,
                    'q1' => $this->input_q1,
                    'q2' => $this->input_q2,
                    'q3' => $this->input_q3,
                    'q4' => $this->input_q4,
                ]);
        } else {
            Risiko::create([
                'piagam' => $this->input_id,
                'so' => $this->input_so,
                'nama' => $this->input_risiko,
                'deskripsi' => $this->input_deskripsi,
                'iru' => $this->input_iru,
                'formula' => $this->input_formula,
                'batas_aman' => $this->input_batas_aman,
                'batas_atas' => $this->input_batas_atas,
                'batas_bawah' => $this->input_batas_bawah,
                'satuan' => $this->input_satuan,
                'jenis_periode' => $this->input_jenis_periode,
                'jenis_lokasi' => $this->input_jenis_lokasi,
                'polarisasi' => $this->input_polarisasi,
                'penanggung_jawab' => $this->input_penanggung_jawab,
                'penyedia_data' => $this->input_penyedia_data,
                'sumber_data' => $this->input_sumber_data,
                'periode_pelaporan' => $this->input_periode_pelaporan,
                'q1' => $this->input_q1,
                'q2' => $this->input_q2,
                'q3' => $this->input_q3,
                'q4' => $this->input_q4,
                'created_by' => Auth::id(),
            ]);
        }

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        // Close input form, we're going back to the list
        $this->closeRisiko();
    }

    // Parse data to input form
    public function edit($id)
    {
        // Find data from the $id
        $data = PiagamRisiko::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_nomor = $data->nomor;
        $this->input_mulai = $data->mulai;
        $this->input_selesai = $data->selesai;
        $this->input_tahun = $data->tahun;
        $this->input_unit = $data->unit;

        // Then input fields and show data
        $this->openModal();
    }

    // Parse data to input form
    public function editRisiko($id)
    {
        // Find data from the $id
        $data = Risiko::findOrFail($id);

        // Parse data from the $data variable
        $this->risiko_id = $id;
        $this->input_so = $data->so;
        $this->input_risiko = $data->nama;
        $this->input_deskripsi = $data->deskripsi;
        $this->input_iru = $data->iru;
        $this->input_formula = $data->formula;
        $this->input_batas_aman = $data->batas_aman;
        $this->input_batas_atas = $data->batas_atas;
        $this->input_batas_bawah = $data->batas_bawah;
        $this->input_satuan = $data->satuan;
        $this->input_jenis_periode = $data->jenis_periode;
        $this->input_jenis_lokasi = $data->jenis_lokasi;
        $this->input_polarisasi = $data->polarisasi;
        $this->input_penanggung_jawab = $data->penanggung_jawab;
        $this->input_penyedia_data = $data->penyedia_data;
        $this->input_sumber_data = $data->sumber_data;
        $this->input_periode_pelaporan = $data->periode_pelaporan;
        $this->input_q1 = $data->q1;
        $this->input_q2 = $data->q2;
        $this->input_q3 = $data->q3;
        $this->input_q4 = $data->q4;

        // Then input fields and show data
        $this->openRisiko($id);
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = PiagamRisiko::where('id', $id)->firstOrFail();

        $sqlChild = Risiko::where('piagam', $id)->delete();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }

    // Delete data
    public function deleteRisiko($id)
    {
        // Find existing photo
        $sql = Risiko::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
