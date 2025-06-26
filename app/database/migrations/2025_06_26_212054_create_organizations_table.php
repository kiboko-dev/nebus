<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedInteger('activity_type_id');
            $table->string('phone');
//            $table->uuid('building_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropForeign('organizations_building_id_foreign');
        });
        Schema::dropIfExists('organizations');
    }
};
