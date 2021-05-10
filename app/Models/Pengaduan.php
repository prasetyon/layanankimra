<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jenisAduan()
    {
        return $this->belongsTo(JenisAduan::class, 'type');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function data()
    {
        return $this->hasMany(TanggapanPengaduan::class, 'aduan');
    }
}
