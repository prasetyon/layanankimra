<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiagamRisiko extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function data()
    {
        return $this->hasMany(Risiko::class, 'piagam')->orderBy('so', 'asc');
    }
}
