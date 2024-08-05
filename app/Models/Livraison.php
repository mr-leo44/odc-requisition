<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
  use HasFactory;

  protected $fillable = [
    'demande_detail_id',
    'quantite'
  ];

  public function demandeDetail() {
    return $this->belongsTo(DemandeDetail::class);
  }

}
