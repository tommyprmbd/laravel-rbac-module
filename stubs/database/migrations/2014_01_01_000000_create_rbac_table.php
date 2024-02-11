<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('description', 180)->nullable();
            $table->timestamps();
            $table->softDeletesDatetime();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('description', 180)->nullable();
            $table->timestamps();
            $table->softDeletesDatetime();
        });

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions', function (Blueprint $table) {
            $table->dropForeign(['role_id', 'permission_id']);
        });
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
