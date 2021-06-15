<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilePengendalianInternal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(ProsesPengendalianInternal::class, 'pi');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
