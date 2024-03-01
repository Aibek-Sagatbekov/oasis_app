<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contract_services_debit', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->change();
        });
        Schema::table('contract_services_debit', function (Blueprint $table) {
            $table->decimal('sum', 15, 2)->change(); // Измените формат с (10, 2) на (15, 2) или другой подходящий для ваших данных
        });
    }

    public function down()
    {
        Schema::table('contract_services_debit', function (Blueprint $table) {
            $table->integer('amount')->change();
        });
        Schema::table('contract_services_debit', function (Blueprint $table) {
            $table->integer('sum')->change();
        });
    }
};