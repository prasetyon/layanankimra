<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengendalianInternal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function auditee()
    {
        return $this->hasMany(AuditeePengendalianInternal::class, 'pi');
    }

    public function perencanaan()
    {
        return $this->hasOne(ProsesPengendalianInternal::class, 'pi')->where('type', 'perencanaan');
    }

    public function pelaksanaan()
    {
        return $this->hasOne(ProsesPengendalianInternal::class, 'pi')
            ->where('type', 'pelaksanaan');
    }

    public function pelaporan()
    {
        return $this->hasOne(ProsesPengendalianInternal::class, 'pi')
            ->where('type', 'pelaporan');
    }

    public function proses()
    {
        return $this->hasMany(ProsesPengendalianInternal::class, 'pi');
    }

    public function prosesPelaksanaan()
    {
        return $this->hasMany(ProsesPengendalianInternal::class, 'pi')->where('type', 'pelaksanaan');
    }

    public function prosesPelaporan()
    {
        return $this->hasMany(ProsesPengendalianInternal::class, 'pi')->where('type', 'pelaporan');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
