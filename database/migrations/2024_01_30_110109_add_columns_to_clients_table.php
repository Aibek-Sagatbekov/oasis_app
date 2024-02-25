<?php

use App\Models\User;
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
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'manager')) {
                $table->renameColumn('manager', 'manager_name');
            }
            if (!Schema::hasColumn('clients', 'manager_id')) {
                $table->foreignIdFor(User::class, 'manager_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'manager_name')) {
                $table->renameColumn('manager_name', 'manager');
            }
            if (Schema::hasColumn('clients', 'manager_id')) {
                $table->dropConstrainedForeignId('manager_id');
            }
        });
    }
};
