<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->foreign('activity_type_id')->references('id')->on('activity_types');
            $table->foreignUuid('building_id')->references('id')->on('buildings');
        });
    }

    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropForeign('organizations_activity_type_id_foreign');
            $table->dropForeign('organizations_building_id_foreign');
        });
    }
};
