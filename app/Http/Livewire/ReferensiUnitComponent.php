<?php

namespace App\Http\Livewire;

use App\Models\ReferensiUnit;
use Livewire\Component;
use Livewire\WithPagination;

class ReferensiUnitComponent extends Component
{
    // Load addon trait
    use WithPagination;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_kl, $input_es1, $input_es2, $input_es3;

    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.referensi-unit-component', [
            // Lists
            'lists' => ReferensiUnit::when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['es1', 'like', '%' . $searchData . '%']
                ])->orWhere([
                    ['es2', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['es3', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['kl', 'like', '%' . $searchData . '%'],
                ]);
            })->paginate($this->paginatedPerPages),
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_id', 'input_kl', 'input_es1', 'input_es2', 'input_es3'
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
            'input_kl' => 'required|string',
            'input_es1' => 'required|string',
            'input_es2' => 'required|string',
            'input_es3' => 'required|string',
        ], $messages);

        // Insert or Update if Ok
        ReferensiUnit::updateOrCreate(['id' => $this->input_id], [
            'kl' => $this->input_kl,
            'es1' => $this->input_es1,
            'es2' => $this->input_es2,
            'es3' => $this->input_es3,
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
        $data = ReferensiUnit::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_kl = $data->kl;
        $this->input_es1 = $data->es1;
        $this->input_es2 = $data->es2;
        $this->input_es3 = $data->es3;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = ReferensiUnit::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
