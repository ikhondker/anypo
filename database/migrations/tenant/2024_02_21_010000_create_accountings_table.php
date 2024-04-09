<?php

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
        Schema::create('accountings', function (Blueprint $table) {
            $table->id()->startingValue(1001);
            $table->string('source')->default('anypo.net');
            $table->string('entity',15); 
            $table->string('event',15); 
			$table->dateTime('accounting_date')->useCurrent(); 
            $table->string('line_description');
            $table->string('ac_expense')->default('A600001');
            $table->string('currency',3);
            $table->float('dr_amount', 15, 2)->default(0);
            $table->float('cr_amount', 15, 2)->default(0);
            $table->string('fc_currency',3);							// Functional Currency
            $table->float('fc_dr_amount', 15, 2)->default(0);
            $table->float('fc_cr_amount', 15, 2)->default(0);
			$table->string('error_code',15)->nullable();
			$table->softDeletes();
			$table->biginteger('created_by')->default(1001);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1001);
			$table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountings');
    }
};
