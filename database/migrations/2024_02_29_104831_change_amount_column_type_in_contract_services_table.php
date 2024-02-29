<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAmountColumnTypeInContractServicesTable extends Migration
{
    public function up()
    {
        Schema::table('contract_services', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('contract_services', function (Blueprint $table) {
            $table->integer('amount')->change();
        });
    }
};
