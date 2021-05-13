<?php

namespace App\Http\Livewire\ManajemenRisiko;

use Livewire\Component;
use Livewire\WithPagination;

class PiagamRisikoComponent extends Component
{
    // Load addon trait
    use WithPagination;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    public $paginatedPerPages = 10;
    public $input_id, $searchTerm, $input_name;
    public function render()
    {
        return view('livewire.manajemen-risiko.piagam-risiko-component');
    }
}
