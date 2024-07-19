<?php

namespace App\Models;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compte extends Model
{
    use HasFactory;
    protected $fillable = [
        "manager",
        "collaborateurs",
        "user_id",
        "service",
        "role",
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'role' => RoleEnum::class,
    ];
}
