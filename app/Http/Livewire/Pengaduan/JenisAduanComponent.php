<?php

namespace App\Http\Livewire\Pengaduan;

use App\Models\JenisAduan;
use Livewire\Component;
use Livewire\WithPagination;

class JenisAduanComponent extends Component
{
    // Load addon trait
    use WithPagination;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_name;

    // View
    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.pengaduan.jenis-aduan-component', [
            // Lists
            'lists' => JenisAduan::when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['name', 'like', '%' . $searchData . '%'],
                ]);
            })->paginate($this->paginatedPerPages),
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_id', 'input_name'
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
            'input_name' => 'required|string',
        ], $messages);

        // Insert or Update if Ok
        JenisAduan::updateOrCreate(['id' => $this->input_id], [
            'name' => $this->input_name,
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
        $data = JenisAduan::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_name = $data->name;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = JenisAduan::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
