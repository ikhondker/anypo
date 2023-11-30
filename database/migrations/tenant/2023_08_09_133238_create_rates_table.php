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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->date('rate_date');
            $table->string('currency',3);
            $table->string('fc_currency',3);
            $table->date('from_date',)->nullable();
            $table->date('to_date',)->nullable();
            $table->double('rate', 15, 10)->default(1);
            $table->double('inverse_rate', 15, 10)->default(1);
            $table->biginteger('created_by')->default(1001);
            $table->timestamp('created_at')->useCurrent();
            $table->biginteger('updated_by')->default(1001);
            $table->timestamp('updated_at')->useCurrent();
            $table->unique(['rate_date','currency','fc_currency']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
