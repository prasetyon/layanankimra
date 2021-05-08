<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkaraAdvokasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jenisPerkara()
    {
        return $this->belongsTo(JenisPerkara::class, 'type');
    }

    public function sidang()
    {
        return $this->hasMany(SidangPerkara::class, 'perkara');
    }
}
