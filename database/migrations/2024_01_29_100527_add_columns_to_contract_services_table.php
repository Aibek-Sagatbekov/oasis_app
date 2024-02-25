<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Indicator;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contract_services', function (Blueprint $table) {
            if (!Schema::hasColumn('contract_services', 'indicator_id')) {
                $table->foreignIdFor(Indicator::class)->after('program_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_services', function (Blueprint $table) {
            if (Schema::hasColumn('contract_services', 'indicator_id')) {
                $table->dropConstrainedForeignId('indicator_id');
            }
        });
    }
};
