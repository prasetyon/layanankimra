<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPengawasan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function requestUndangan()
    {
        return $this->hasMany(UndanganPengawasan::class, 'pengawasan')
            ->where('type', $this->type)
            ->orderBy('id', 'desc');
    }

    public function file()
    {
        return $this->hasMany(FilePengawasan::class, 'pengawasan')
            ->where('type', $this->type)
            ->where('unit', '-')
            ->orderBy('id', 'desc');
    }
}
