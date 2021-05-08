<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatHukum extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function jenisPerkara()
    {
        return $this->belongsTo(JenisPerkara::class, 'type');
    }

    public function file()
    {
        return $this->hasMany(FilePendapatHukum::class, 'perkara');
    }
}
