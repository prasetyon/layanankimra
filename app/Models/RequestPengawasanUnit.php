<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestPengawasanUnit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function file()
    {
        return $this->hasMany(FilePengawasan::class, 'pengawasan')
            ->where('type', $this->type)
            ->where('unit', $this->unit)
            ->orderBy('id', 'desc');
    }
}
