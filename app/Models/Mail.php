<?php

namespace App\Models;

use App\Models\Demande;
use App\Models\Approbateur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mail extends Model
{
    use HasFactory;
    protected $fillable = [
        'demande_id',
        'approbateur_id',
        'is_approved',
    ];

    public function demande() : BelongsTo
    {
        return $this->belongsTo(Demande::class);
    }

    public function approbateur() : BelongsTo
    {
        return $this->belongsTo(Approbateur::class);
    }

}
