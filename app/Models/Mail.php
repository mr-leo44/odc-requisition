<?php

namespace App\Models;

use App\Models\Traitement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mail extends Model
{
    use HasFactory;
    protected $fillable = [
        'traitement_id',
        'is_approved',
    ];

    public function traitement() : BelongsTo
    {
        return $this->belongsTo(Traitement::class);
    }

}
