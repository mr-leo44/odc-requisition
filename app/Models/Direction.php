<?php

namespace App\Models;

use App\Models\Compte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function comptes()
    {
        return $this->hasMany(Compte::class);
    }
}
