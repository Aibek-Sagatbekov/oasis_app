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
        Schema::table('service_types', function (Blueprint $table) {
            if (!Schema::hasColumn('service_types', 'parent_id')) $table->integer('parent_id')->default(-1);
            if (!Schema::hasColumn('service_types', 'order')) $table->integer('order')->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_types', function (Blueprint $table) {
            if (Schema::hasColumn('service_types', 'parent_id')) $table->dropColumn('parent_id');
            if (Schema::hasColumn('service_types', 'order')) $table->dropColumn('order');
        });
    }
};
