<?php

use App\Models\Area;
use App\Models\City;
use App\Models\Contract;
use App\Models\District;
use App\Models\Indicator;
use App\Models\Program;
use App\Models\ServiceType;
use App\Models\State;
use App\Models\Station;
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
        Schema::create('debits', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Contract::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->enum('activity_type', ['main', 'non-main'])->default('main');

            $table->foreignIdFor(Indicator::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Program::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->integer('count')->default(0);

            $table->foreignIdFor(State::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Area::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(District::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(City::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Station::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();

            $table->string('period')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debits');
    }
};
