<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangPerkara extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(PerkaraAdvokasi::class, 'perkara');
    }

    public function jenisSidang()
    {
        return $this->belongsTo(JenisSidang::class, 'type');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function file()
    {
        return $this->hasMany(FileSidangPerkara::class, 'perkara');
    }
}
