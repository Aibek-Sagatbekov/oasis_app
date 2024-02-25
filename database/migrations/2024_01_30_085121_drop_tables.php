<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $delMigrations = [
        '2023_06_11_093810_create_customers_table',
        '2023_06_11_120237_create_customer_details_table',
        '2023_06_12_095017_create_payments_table',
        '2023_06_13_114251_create_customer_payment_table',
        '2023_06_13_162245_create_customer_shipings_table',
        '2023_06_21_104423_create_shiping_address_coolers_table',
        '2023_06_21_111637_create_shiping_address_taras_table',
        '2023_06_21_113513_create_shiping_address_balances_table',
        '2023_06_21_115545_create_shiping_address_work_times_table',
        '2023_06_23_102824_create_products_table',
        '2023_06_23_115107_create_cars_table',
        '2023_06_25_163620_create_customer_talon_balances_table',
        '2023_06_25_144945_create_customer_individual_prices_table',
        '2023_06_28_120012_create_user_address_residents_table',
        '2023_06_28_123137_create_user_address_places_table',
        '2023_06_28_131830_create_user_passports_table',
        '2023_06_28_145819_create_couriers_table',
        '2023_07_10_103626_create_orders_table',
    ];

    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customer_details');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('customer_payment');
        Schema::dropIfExists('customer_shipings');
        Schema::dropIfExists('shiping_address_coolers');
        Schema::dropIfExists('shiping_address_taras');
        Schema::dropIfExists('shiping_address_balances');
        Schema::dropIfExists('shiping_address_work_times');
        Schema::dropIfExists('products');
        Schema::dropIfExists('cars');
        Schema::dropIfExists('customer_individual_prices');
        Schema::dropIfExists('customer_talon_balances');
        Schema::dropIfExists('user_address_residents');
        Schema::dropIfExists('user_address_places');
        Schema::dropIfExists('user_passports');
        Schema::dropIfExists('couriers');
        Schema::dropIfExists('orders');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        collect($this->delMigrations)->map(function ($migration) {
            DB::table('migrations')->where('migration', $migration)->delete();
            if (file_exists(database_path('migrations/' . $migration . '.php'))) unlink(database_path('migrations/' . $migration . '.php'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
