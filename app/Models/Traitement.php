<?php

namespace App\Models;

use App\Models\Demande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Traitement extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'status',
        'observation',
        'demande_id',
        'demandeur_id',
        'approbateur_id',
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}
