<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuanTinjut extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function statusUIC()
    {
        return $this->belongsTo(StatusAksi::class, 'status_uic');
    }

    public function statusAPK()
    {
        return $this->belongsTo(StatusAksi::class, 'status_apk');
    }

    public function forumBPK()
    {
        return $this->belongsTo(StatusAksi::class, 'status_apk');
    }

    public function type()
    {
        return $this->belongsTo(JenisPemeriksaan::class, 'jenis_pemeriksaan');
    }

    public function pemeriksa()
    {
        return $this->belongsTo(AparatPemeriksa::class, 'aparat_pemeriksa');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function data()
    {
        return $this->hasMany(DataTinjut::class, 'tinjut')->orderBy('id', 'desc');
    }

    public function file()
    {
        return $this->hasMany(FileTinjut::class, 'tinjut')->orderBy('id', 'desc');
    }
}
