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
        Schema::create('pos', function (Blueprint $table) {
            $table->id()->startingValue(1001);
            $table->dateTime('po_date')->useCurrent();
            $table->dateTime('delivery_date')->useCurrent();
            $table->string('summary');
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('dept_id')->constrained('depts');
            $table->foreignId('supplier_id')->constrained('organizations');
            $table->string('salse_person')->nullable();
            $table->foreignId('project_id')->constrained('projects')->nullable();
            $table->text('notes')->nullable();
            $table->float('subtotal')->default(0);
            $table->float('tax')->default(0);
            $table->float('vat')->default(0);
            $table->float('amount')->default(0);
            $table->string('currency',3)->default('USD');
            $table->enum('status', ['OPEN','CANCELED','CLOSED'])->default('OPEN');
            $table->enum('auth_status', ['DRAFT','SUBMITTED','IN-PROCESS','APPROVED','REJECTED','ERROR'])->default('DRAFT');
            $table->float('amount_paid')->default(0);
            $table->enum('pay_status', ['DUE','PAID','PARITAL','ERROR'])->default('DUE');
            $table->enum('close_status', ['OPEN','CLOSED','PARTAL','ERROR'])->default('OPEN');
            $table->dateTime('submission_date')->nullable();
            //$table->string('pay_desc')->nullable();
            //$table->date('pay_date')->nullable()->useCurrent();
            //$table->foreignId('bank_account_id')->constrained('bank_accounts')->nullable();
            //$table->integer('bank_account_id')->default(0);
            //$table->float('pay_amount')->default(0);
            //$table->string('cheque_no')->nullable();
            //$table->biginteger('paid_by')->nullable();
            $table->string('wf_key',10)->default('WFPO');
            $table->integer('hierarchy_id')->default(0);
            $table->integer('wf_id')->default(0);
            $table->dateTime('auth_date',)->nullable();
            $table->integer('auth_userid')->nullable();
            $table->boolean('open')->default(true); 
            $table->softDeletes();
            $table->biginteger('created_by')->default(1001);
            $table->timestamp('created_at')->useCurrent();
            $table->biginteger('updated_by')->default(1001);
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('company')->references('company')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos');
    }
};
