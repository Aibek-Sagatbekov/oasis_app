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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();


            $table->string('name');
            $table->enum('type', ['COMMERCE', 'GOVERMENTAL']);

            $table->foreignIdFor(City::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('address')->nullable();

            $table->string('RNN')->nullable();
            $table->string('IIK')->nullable();
            $table->string('BIN')->nullable();
            $table->string('BIK')->nullable();
            $table->string('BANK')->nullable();
            $table->string('KBE')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
