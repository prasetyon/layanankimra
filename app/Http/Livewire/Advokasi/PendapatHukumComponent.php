<?php

namespace App\Http\Livewire\Advokasi;

use App\Models\FilePendapatHukum;
use App\Models\JenisPerkara;
use App\Models\PendapatHukum;
use App\Models\ReferensiUnit;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PendapatHukumComponent extends Component
{
    // Load addon trait
    use WithPagination, WithFileUploads;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $isKajianHukum = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_perihal, $input_keterangan;
    public $input_tanggal, $input_unit, $input_type, $user;
    public $listFiles;
    public $photos = [];

    public function mount()
    {
        $this->user = Auth::id();
    }

    // View
    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.advokasi.pendapat-hukum-component', [
            // Lists
            'listType' => JenisPerkara::where('type', 'LIKE', 'non litigasi')->get(),
            'listUnit' => ReferensiUnit::select('es2')->distinct()->get(),
            'lists' => PendapatHukum::when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['perihal', 'like', '%' . $searchData . '%']
                ])->orWhere([
                    ['keterangan', 'like', '%' . $searchData . '%'],
                ]);
            })->paginate($this->paginatedPerPages)
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_id', 'input_perihal', 'input_keterangan',
            'input_tanggal', 'input_unit'
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
        $this->resetInputFields();
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
            'input_perihal' => 'required',
            'input_tanggal' => 'required',
            'input_unit' => 'required',
            'input_type' => 'required',
        ], $messages);


        // Insert or Update if Ok
        $data = PendapatHukum::updateOrCreate(['id' => $this->input_id], [
            'perihal' => $this->input_perihal,
            'keterangan' => $this->input_keterangan,
            'tanggal' => $this->input_tanggal,
            'unit' => $this->input_unit,
            'type' => $this->input_type,
            'created_by' => $this->user ?? 1,
        ]);

        $id = $data->id;

        foreach ($this->photos as $photo) {
            $fileName = time() . '_' . $id . '_' . strtolower(preg_replace('/\s+/', '_', $photo->getClientOriginalName()));
            $photo->storeAs('advokasi', $fileName);

            FilePendapatHukum::insert([
                'perkara' => $id,
                'name' => $fileName,
                'created_by' => Auth::id() ?? 1,
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
        $jenis = PendapatHukum::findOrFail($id);

        // Parse data from the $jenis variable
        $this->input_id = $id;
        $this->input_perihal = $jenis->perihal;
        $this->input_keterangan = $jenis->keterangan;
        $this->input_tanggal = $jenis->tanggal;
        $this->input_unit = $jenis->unit;
        $this->input_type = $jenis->type;
        $this->listFiles = $jenis->file;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = PendapatHukum::select('file')->where('id', $id)->firstOrFail();

        foreach ($sql->file as $f) {
            unlink(storage_path('app/advokasi/' . substr(str_replace(env('APP_URL') . '/file/advokasi', "", $f->file), 1)));
        }
        $file = FilePendapatHukum::where('perkara', $f->id)->delete();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }

    public function deleteFile($id)
    {
        // Find existing photo
        $sql = FilePendapatHukum::select('file')->where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Then delete it
        unlink(storage_path('app/advokasi/' . substr(str_replace(env('APP_URL') . '/file/advokasi', "", $sql->file), 1)));

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
        $this->closeModal();
    }
}
