<?php

namespace App\Models;
use App\Models\Mail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approbateur extends Model
{
    use HasFactory;
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
