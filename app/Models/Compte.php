<?php

namespace App\Models;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Models\Direction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compte extends Model
{
    use HasFactory;
    protected $fillable = [
        "manager",
        "service",
        "role",
        "user_id",
        "direction_id",
        "city",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function direction(): BelongsTo
    {
        return $this->belongsTo(Direction::class);
    }

    protected $casts = [
        'role' => RoleEnum::class,
    ];
}
