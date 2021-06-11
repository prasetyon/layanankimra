<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermindokPengawasan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function requestUnit()
    {
        return $this->hasMany(RequestPengawasanUnit::class, 'pengawasan')
            ->where('type', 'B');
    }
}
