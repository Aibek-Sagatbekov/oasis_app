<?php

use App\Models\ProgramType;
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
        Schema::table('programs', function (Blueprint $table) {

            if (!Schema::hasColumn('programs', 'program_type_id')) {
                $table->foreignIdFor(ProgramType::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            if (Schema::hasColumn('programs', 'program_type_id')) {
                $table->dropForeign(['program_type_id']);
                $table->dropColumn('program_type_id');
            }
        });
    }
};
