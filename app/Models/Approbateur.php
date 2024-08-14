<?php

namespace App\Models;
use App\Models\Mail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approbateur extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =[
        'level',
        'name',
        'fonction',
        'email'

    ];
    
    public function mails(){

        return $this->hasMany(Mail::class);
    }
}
