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
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->startingValue(1001);
            $table->dateTime('pay_date')->useCurrent();
            $table->foreignId('payer_id')->constrained('users');
            $table->string('summary');
            $table->foreignId('pay_method_id')->constrained('pay_methods')->nullable();
            $table->string('cheque_no')->nullable();
            $table->float('amount')->default(0);
            $table->string('base_currency',3)->default('USD');
            $table->float('base_exchange_rate')->default(1);
            $table->float('base_amount')->default(0);
            $table->foreignId('organization_id')->constrained('organizations');
            //$table->biginteger('for_doc_type_id')->constrained('doc_types');
            $table->string('for_entity',15); 
            $table->biginteger('po_id')->default(0);
            $table->biginteger('article_id')->default(0);
            $table->text('notes')->nullable();
            $table->enum('status', ['DRAFT','POSTED','CONFIRMED','VOID'])->default('DRAFT');
            $table->biginteger('created_by')->default(1001);
            $table->timestamp('created_at')->useCurrent();
            $table->biginteger('updated_by')->default(1001);
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('for_entity')->references('entity')->on('entities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
