<?php

namespace App\Http\Livewire\PengendalianInternal;

use App\Models\AuditeePengendalianInternal;
use App\Models\FilePengendalianInternal;
use App\Models\PengendalianInternal;
use App\Models\ProsesPengendalianInternal;
use App\Models\ReferensiUnit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PiComponent extends Component
{
    // Load addon trait
    use WithPagination, WithFileUploads;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0, $isOpenAuditee = 0, $isOpenProses = 0, $isOpenChat = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_tahun, $input_kegiatan;
    public $input_unit, $input_to;
    public $input_type, $input_uraian;
    public $modul, $proses;
    public $photos = [];

    public function mount($modul)
    {
        $this->modul = $modul;
    }

    // View
    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.pengendalian-internal.pi-component', [
            // Lists
            // 'proses' => $this->proses,
            'loggedUser' => Auth::user(),
            'listUnit' => ReferensiUnit::select('es2')->distinct()->get(),
            'selectedData' => PengendalianInternal::where('id', $this->input_id)->first(),
            'lists' => PengendalianInternal::where('modul', $this->modul)
                ->when($searchData, function ($searchQuery) use ($searchData) {
                    $searchQuery->where([
                        ['kegiatan', 'like', '%' . $searchData . '%']
                    ])->where([
                        ['tahun', 'like', '%' . $searchData . '%']
                    ]);
                })->paginate($this->paginatedPerPages),
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_kegiatan', 'input_tahun', 'input_uraian'
        ]);
    }

    // Open input form
    public function openModal()
    {
        $this->isOpen = true;
        $this->isOpenAuditee = false;
        $this->isOpenProses = false;
        $this->isOpenChat = false;
    }

    // Open input form
    public function openChat($id, $type, $role)
    {
        $this->input_id = $id;
        $this->input_type = $type;

        $this->isOpen = false;
        $this->isOpenAuditee = false;
        $this->isOpenProses = false;
        $this->isOpenChat = true;

        $this->input_to = in_array($role, ['admin', 'superuser']) ? 'all' : null;
    }

    // Open input form
    public function openProses($id, $type)
    {
        $this->isOpen = false;
        $this->isOpenAuditee = false;
        $this->isOpenProses = true;
        $this->isOpenChat = false;

        $this->input_id = $id;
        $this->input_type = $type;

        if ($type = "perencanaan") {
            $data = ProsesPengendalianInternal::where('pi', $id)->first();
            $this->input_uraian = $data->uraian ?? null;
        }
    }

    // Approve data
    public function approve($id, $status)
    {
        $user = Auth::user();
        $stat = $status == 'perencanaan' ? 'pelaksanaan' : ($status == 'pelaksanaan' ? 'pelaporan' : 'selesai');

        PengendalianInternal::where('id', $id)->update(['status' => $stat]);

        // Show an alert
        $this->alert('success', 'Data berhasil diapprove');
    }

    // Close input form
    public function closeModal()
    {
        $this->isOpen = false;
        $this->isOpenAuditee = false;
        $this->isOpenProses = false;
        $this->isOpenChat = false;

        // Reset input fields for next input
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
            'input_kegiatan' => 'required|string',
            'input_tahun' => 'required',
        ], $messages);

        // Insert or Update if Ok
        PengendalianInternal::updateOrCreate(['id' => $this->input_id], [
            'kegiatan' => $this->input_kegiatan,
            'tahun' => $this->input_tahun,
            'modul' => $this->modul,
            'created_by' => Auth::id(),
        ]);

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        // Close input form, we're going back to the list
        $this->closeModal();
    }

    public function storeProses()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_uraian' => 'required|string',
        ], $messages);

        // Insert or Update if Ok

        if ($this->input_type == 'perencanaan') {
            $data = ProsesPengendalianInternal::updateOrCreate(['pi' => $this->input_id], [
                'uraian' => $this->input_uraian,
                'type' => $this->input_type,
                'from' => Auth::id(),
                'to' => null,
                'created_by' => Auth::id(),
            ]);
        } else {
            $data = ProsesPengendalianInternal::create([
                'pi' => $this->input_id,
                'uraian' => $this->input_uraian,
                'type' => $this->input_type,
                'from' => Auth::id(),
                'to' => $this->input_to ?? null,
                'created_by' => Auth::id(),
            ]);
        }

        $id = $data->id;

        foreach ($this->photos as $photo) {
            $fileName = time() . '_' . $id . '_' . strtolower(preg_replace('/\s+/', '_', $photo->getClientOriginalName()));
            $photo->storeAs('pi', $fileName);

            FilePengendalianInternal::create([
                'pi' => $id,
                'name' => $fileName,
                'created_by' => Auth::id(),
                'file' => env('APP_URL') . '/file/pi/' . $fileName,
            ]);
        }

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        if ($this->input_type == 'perencanaan') {
            $this->closeModal();
        } else {
            $this->resetInputFields();
        }
    }

    // Save data
    public function storeAuditee()
    {
        $messages = [
            '*.required' => 'This column is required',
            '*.numeric' => 'This column is required to be filled in with number',
            '*.string' => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'input_unit' => 'required|string',
        ], $messages);

        // Insert or Update if Ok
        AuditeePengendalianInternal::create([
            'pi' => $this->input_id,
            'unit' => $this->input_unit,
            'created_by' => Auth::id(),
        ]);

        // Show an alert
        $this->alert('success', 'Data berhasil disimpan');

        // Close input form, we're going back to the list
        $this->closeModal();
    }

    // Parse data to input form
    public function edit($id)
    {
        // Find data from the $id
        $data = PengendalianInternal::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_kegiatan = $data->kegiatan;
        $this->input_tahun = $data->tahun;

        // Then input fields and show data
        $this->openModal();
    }

    // Open input form
    public function openAuditee($id)
    {
        $this->input_id = $id;

        $this->isOpen = false;
        $this->isOpenAuditee = true;
        $this->isOpenProses = false;
        $this->isOpenChat = false;
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = PengendalianInternal::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }

    // Delete data
    public function deleteAuditee($id)
    {
        // Find existing photo
        $sql = AuditeePengendalianInternal::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }

    public function deleteFile($id)
    {
        // Find existing photo
        $sql = FilePengendalianInternal::select('file')->where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Then delete it
        unlink(storage_path('app/pi/' . substr(str_replace(env('APP_URL') . '/file/pi', "", $sql->file), 1)));

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
