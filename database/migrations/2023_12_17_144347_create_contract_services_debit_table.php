<?php

use App\Models\ContractServices;
use App\Models\Debit;
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
        Schema::create('contract_services_debit', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Debit::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(ContractServices::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->integer('count')->nullable()->default(0);
            $table->integer('amount')->nullable()->default(0);
            $table->integer('sum')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_services_debit');
    }
};
