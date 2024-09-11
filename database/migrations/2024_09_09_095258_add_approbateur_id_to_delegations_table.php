<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprobateurIdToDelegationsTable extends Migration
{
    public function up()
    {
        Schema::table('delegations', function (Blueprint $table) {
            $table->foreignId('approbateur_id')->nullable()->constrained('approbateurs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('delegations', function (Blueprint $table) {
            $table->dropForeign(['approbateur_id']);
            $table->dropColumn('approbateur_id');
        });
    }
}
  