<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prerequisito extends Model
{
    use HasFactory;

    protected $table = 'prerequisitos';

    protected $fillable = [
        'materia_id',
        'materia_prerequisito_id',
    ];
}
