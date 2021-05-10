<?php

namespace App\Http\Livewire;

use App\Models\ReferensiUnit;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    // Load addon trait
    use WithPagination;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_kl, $input_es1, $input_es2, $input_es3, $input_es4;
    public $input_name, $input_username, $input_role, $input_fitur;
    public $input_email, $input_nik, $input_phone, $input_address;

    // View
    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.user-component', [
            'listKL' => ReferensiUnit::select('kl')->distinct()->get(),
            'listES1' => ReferensiUnit::select('es1')->where('kl', $this->input_kl)->distinct()->get(),
            'listES2' => ReferensiUnit::select('es2')->where('kl', $this->input_kl)->where('es1', $this->input_es1)->distinct()->get(),
            'listES3' => ReferensiUnit::select('es3')->where('kl', $this->input_kl)->where('es1', $this->input_es1)->where('es2', $this->input_es2)->distinct()->get(),
            'lists' => User::when($searchData, function ($searchQuery) use ($searchData) {
                $searchQuery->where([
                    ['es1', 'like', '%' . $searchData . '%']
                ])->orWhere([
                    ['es2', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['es3', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['es4', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['kl', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['name', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['username', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['role', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['fitur', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['email', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['nik', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['phone', 'like', '%' . $searchData . '%'],
                ])->orWhere([
                    ['address', 'like', '%' . $searchData . '%'],
                ]);
            })->paginate($this->paginatedPerPages),
        ]);
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->reset([
            'input_id', 'input_kl', 'input_es1', 'input_es2', 'input_es3', 'input_es4',
            'input_name', 'input_username', 'input_role', 'input_fitur'
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
            'input_username' => 'required|string',
            'input_role' => 'required|string',
        ], $messages);

        // Insert or Update if Ok
        if (isset($this->input_id)) {
            User::where(['id' => $this->input_id])
                ->update([
                    'kl' => $this->input_kl,
                    'es1' => $this->input_es1,
                    'es2' => $this->input_es2,
                    'es3' => $this->input_es3,
                    'es4' => $this->input_es4,
                    'username' => $this->input_username,
                    'name' => $this->input_name,
                    'role' => $this->input_role,
                    'fitur' => $this->input_fitur,
                    'email' => $this->input_email,
                    'nik' => $this->input_nik,
                    'address' => $this->input_address,
                    'phone' => $this->input_phone,
                ]);
        } else {
            User::create([
                'id' => $this->input_id,
                'kl' => $this->input_kl,
                'es1' => $this->input_es1,
                'es2' => $this->input_es2,
                'es3' => $this->input_es3,
                'es4' => $this->input_es4,
                'username' => $this->input_username,
                'password' => bcrypt('123'),
                'name' => $this->input_name,
                'role' => $this->input_role,
                'fitur' => $this->input_fitur,
                'email' => $this->input_email,
                'nik' => $this->input_nik,
                'address' => $this->input_address,
                'phone' => $this->input_phone,
            ]);
        }

        // Show an alert
        $this->alert('success', $this->input_id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan');

        // Close input form, we're going back to the list
        $this->closeModal();

        // Reset input fields for next input
        $this->resetInputFields();
    }

    public function resetPassword($id)
    {
        $auth = User::where('id', $id)->update(['password' => bcrypt('123')]);

        $this->alert('success', 'Reset password berhasil');
    }

    // Parse data to input form
    public function edit($id)
    {
        // Find data from the $id
        $data = User::findOrFail($id);

        // Parse data from the $data variable
        $this->input_id = $id;
        $this->input_kl = $data->kl;
        $this->input_es1 = $data->es1;
        $this->input_es2 = $data->es2;
        $this->input_es3 = $data->es3;
        $this->input_es4 = $data->es4;
        $this->input_name = $data->name;
        $this->input_username = $data->username;
        $this->input_role = $data->role;
        $this->input_fitur = $data->fitur;
        $this->input_email = $data->email;
        $this->input_nik = $data->nik;
        $this->input_address = $data->address;
        $this->input_phone = $data->phone;

        // Then input fields and show data
        $this->openModal();
    }

    // Delete data
    public function delete($id)
    {
        // Find existing photo
        $sql = User::where('id', $id)->firstOrFail();

        // Delete Data from DB
        $sql->find($id)->delete();

        // Show an alert
        $this->alert('warning', 'Data berhasil dihapus');
    }
}
