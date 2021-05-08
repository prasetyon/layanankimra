<?php

namespace App\Http\Livewire\Advokasi;

use App\Models\ReferensiPeraturan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ReferensiPeraturanComponent extends Component
{
    // Load addon trait
    use WithPagination, WithFileUploads;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $isKajianHukum = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_detail, $input_name, $input_file, $user;

    public function mount()
    {
        $this->user = Auth::id();
    }

    // View
    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.advokasi.referensi-peraturan-component', [
            // Lists
            'lists' => ReferensiPeraturan::where('type', 'peraturan')
                ->when($searchData, function ($searchQuery) use ($searchData) {
                    $searchQuery->where([
                        ['detail', 'like', '%' . $searchData . '%']
                    ])->orWhere([
                        ['name', 'like', '%' . $searchData . '%'],
                    ]);
                })->paginate($this->paginatedPerPages)
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_id', 'input_detail', 'input_name', 'input_file'
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
            '*.file' => 'This column must be a file',
            '*.max:2048' => 'File can not be more than 2.048 kb',
        ];

        $this->validate([
            'input_file' => 'required|file|max:2048',
            'input_name' => 'required',
        ], $messages);

        $fileName = time() . '_' . strtolower(preg_replace('/\s+/', '_', $this->input_file->getClientOriginalName()));

        // Upload Photo if this is a 'Create'
        if ($this->input_id == false) {
            $this->input_file->storeAs('referensi', $fileName);
        }

        // Delete Existing Photo and then Upload the New One if this is an 'Update'
        elseif ($this->input_id == true) {
            // Find existing photo
            $sql = ReferensiPeraturan::select('id', 'file')->where('id', $this->input_id)->firstOrFail();

            // Then delete it
            unlink(storage_path('app/referensi/' . substr(str_replace(env('APP_URL') . '/file/referensi', "", $sql->file), 1)));

            // And upload the new one
            $this->input_file->storeAs('referensi', $fileName);
        }

        // Insert or Update if Ok
        ReferensiPeraturan::updateOrCreate(['id' => $this->input_id], [
            'type' => 'peraturan',
            'detail' => $this->input_detail,
            'name' => $this->input_name,
            'created_by' => $this->user ?? 1,
            'file' => env('APP_URL') . '/file/referensi/' . $fileName,
        ]);

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
        $jenis = ReferensiPeraturan::findOrFail($id);

        // Parse data from the $jenis variable
        $this->input_id = $id;
        $this->input_detail = $jenis->detail;
        $this->input_name = $jenis->name;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = ReferensiPeraturan::select('file')->where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Then delete it
        unlink(storage_path('app/referensi/' . substr(str_replace(env('APP_URL') . '/file/referensi', "", $sql->file), 1)));

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
