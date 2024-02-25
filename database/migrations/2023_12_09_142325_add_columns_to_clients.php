<?php

use App\Models\City;
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
            if (Schema::hasColumn('clients', 'city_id')) {
                $table->dropForeign(['city_id']);
                $table->dropColumn('city_id');
            }
            if (Schema::hasColumn('clients', 'address')) {
                $table->dropColumn('address');
            }

            $table->unsignedBigInteger('actual_city_id')->after('type')->nullable();
            $table->foreign('actual_city_id')
                ->references('id')
                ->on('cities')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('actual_address')->after('actual_city_id')->nullable();

            $table->unsignedBigInteger('legal_city_id')->after('actual_address')->nullable();
            $table->foreign('legal_city_id')
                ->references('id')
                ->on('cities')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('legal_address')->after('legal_city_id')->nullable();

            $table->string('manager')->nullable();
            $table->text('contacts')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {

            if (Schema::hasColumn('clients', 'actual_city_id')) {
                $table->dropForeign(['actual_city_id']);
                $table->dropColumn('actual_city_id');
            }
            if (Schema::hasColumn('clients', 'legal_city_id')) {
                $table->dropForeign(['legal_city_id']);
                $table->dropColumn('legal_city_id');
            }
            if (Schema::hasColumn('clients', 'actual_address')) {
                $table->dropColumn('actual_address');
            }
            if (Schema::hasColumn('clients', 'legal_address')) {
                $table->dropColumn('legal_address');
            }

            $table->foreignIdFor(City::class)->after('type')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('address')->after('city_id')->nullable();
            $table->dropColumn(['manager', 'contacts']);
        });
    }
};
