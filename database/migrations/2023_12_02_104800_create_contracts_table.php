<?php

use App\Models\Client;
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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['local', 'center'])->default('local');
            $table->string('number');
            $table->dateTime('date')->useCurrent();

            $table->foreignIdFor(Client::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->dateTime('date_start');
            $table->dateTime('date_end');

            $table->text('comment')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
