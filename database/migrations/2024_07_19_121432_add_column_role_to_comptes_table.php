<?php

use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comptes', function (Blueprint $table) {
            $table->string('role')->default(RoleEnum::USER->value)->after('service');
            $table->dropColumn('is_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comptes', function (Blueprint $table) {
            //
        });
    }
};
