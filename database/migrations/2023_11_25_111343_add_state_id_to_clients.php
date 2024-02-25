<?php

use App\Models\Area;
use App\Models\District;
use App\Models\State;
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

            // REMOVE COLUMN RNN

            if (Schema::hasColumn('clients', 'RNN')) {
                $table->dropColumn('RNN');
            }

            // ADD COLUMN STATE_ID AND FOREIGN_KEY

            if (!Schema::hasColumn('clients', 'state_id')) {
                $table->foreignIdFor(State::class)->after('city_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            }

            // ADD COLUMN AREA_ID AND FOREIGN_KEY

            if (!Schema::hasColumn('clients', 'area_id')) {
                $table->foreignIdFor(Area::class)->after('city_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            }

            // ADD COLUMN DISTRICT_ID AND FOREIGN_KEY

            if (!Schema::hasColumn('clients', 'district_id')) {
                $table->foreignIdFor(District::class)->after('city_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {

            if (!Schema::hasColumn('clients', 'RNN')) {
                $table->string('RNN')->nullable()->after('address');
            };

            if (Schema::hasColumn('clients', 'state_id')) {
                $table->dropForeign(['state_id']);
                $table->dropColumn('state_id');
            };

            if (Schema::hasColumn('clients', 'area_id')) {
                $table->dropForeign(['area_id']);
                $table->dropColumn('area_id');
            };
            if (Schema::hasColumn('clients', 'district_id')) {
                $table->dropForeign(['district_id']);
                $table->dropColumn('district_id');
            };
        });
    }
};
