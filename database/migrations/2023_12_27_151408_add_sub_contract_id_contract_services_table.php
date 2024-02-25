<?php

use App\Models\Contract;
use App\Models\SubContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contract_services', function (Blueprint $table) {

            if (!Schema::hasColumn('contract_services', 'sub_contract_id')) {
                $table->foreignIdFor(SubContract::class)->after('contract_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_services', function (Blueprint $table) {

            if (Schema::hasColumn('contract_services', 'sub_contract_id')) {
                $table->dropConstrainedForeignId('sub_contract_id');
            }
        });
    }
};
