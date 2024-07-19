<?php

namespace App\Models;

use App\Models\Mail;
use App\Models\User;
use App\Models\Service;
use App\Models\DemandeDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traitement;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'service',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mails()
    {
        return $this->hasMany(Mail::class);
    }
    public function demande_details()
    {
        return $this->hasMany(DemandeDetail::class);
    }
    public function traitement()
    {
        return $this->hasMany(Traitement::class);
    }
}
