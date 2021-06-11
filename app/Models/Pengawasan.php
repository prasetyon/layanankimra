<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function jenisPengawasan()
    {
        return $this->belongsTo(JenisPengawasan::class, 'jenis');
    }

    public function aparatPemeriksa()
    {
        return $this->belongsTo(AparatPemeriksa::class, 'aparat');
    }

    public function file()
    {
        return $this->hasMany(FilePengawasan::class, 'pengawasan')->where('type', 'PR');
    }

    public function permindok()
    {
        return $this->hasMany(PermindokPengawasan::class, 'pengawasan')->orderBy('id', 'desc');
    }

    public function ekspose()
    {
        return $this->hasMany(EksposePengawasan::class, 'pengawasan')->orderBy('id', 'desc');
    }

    public function kriteria()
    {
        return $this->hasMany(KriteriaPengawasan::class, 'pengawasan')->where('type', 'D1')->orderBy('id', 'desc');
    }

    public function hasil()
    {
        return $this->hasMany(KriteriaPengawasan::class, 'pengawasan')->where('type', 'D2')->orderBy('id', 'desc');
    }
}
