<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'status',
        'observation',
        'demande_id',
        'approbateur_id',
    ];
}
