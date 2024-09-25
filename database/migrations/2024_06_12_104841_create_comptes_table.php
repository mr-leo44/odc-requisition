<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\RoleEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->integer('manager');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('service');
            $table->string('city');
            $table->string('role')->default(RoleEnum::USER->value);
            $table->boolean('is_activated')->default(true);
            $table->foreignId('direction_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
