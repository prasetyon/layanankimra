<?php

namespace App\Http\Livewire\ManajemenRisiko;

use App\Models\SasaranOrganisasi;
use Livewire\Component;
use Livewire\WithPagination;

class SasaranOrganisasiComponent extends Component
{
    // Load addon trait
    use WithPagination;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_name, $input_kode;

    // View
    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.manajemen-risiko.sasaran-organisasi-component', [
            // Lists
            'lists' => SasaranOrganisasi::when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['name', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['kode', 'like', '%' . $searchData . '%'],
                ]);;
            })->paginate($this->paginatedPerPages),
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_id', 'input_name', 'input_kode'
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
            'input_kode' => 'required|string',
        ], $messages);

        // Insert or Update if Ok
        SasaranOrganisasi::updateOrCreate(['id' => $this->input_id], [
            'name' => $this->input_name,
            'kode' => $this->input_kode,
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
        $data = SasaranOrganisasi::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_name = $data->name;
        $this->input_kode = $data->kode;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = SasaranOrganisasi::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
