<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'demande_id',
        'designation',
        'qte_demandee',
        'qte_livree'
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}
