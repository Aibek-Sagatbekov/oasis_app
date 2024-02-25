<?php

use App\Models\Contract;
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
        Schema::create('sub_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignIdFor(Contract::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->dateTime('date_start');
            $table->dateTime('date_end');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contracts');
    }
};
