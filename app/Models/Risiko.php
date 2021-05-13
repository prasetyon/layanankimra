<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risiko extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Pengaduan::class, 'aduan');
    }

    public function sasaranOrganisasi()
    {
        return $this->belongsTo(SasaranOrganisasi::class, 'so');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
