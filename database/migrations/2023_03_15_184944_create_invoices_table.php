<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\LandlordInvoiceTypeEnum;


return new class extends Migration
{
    /**
     * Run the migrations.
     */ 
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->startingValue(1001);
            $table->string('summary');
            $table->string('invoice_no')->unique();
            $table->string('invoice_type')->default(LandlordInvoiceTypeEnum::SUBSCRIPTION->value); 
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('owner_id')->nullable()->constrained('users');
            $table->dateTime('invoice_date', $precision = 0)->nullable()->useCurrent();
            $table->date('from_date');
            $table->date('to_date');
            $table->date('org_from_date')->nullable();
            $table->dateTime('due_date', $precision = 0)->nullable()->useCurrent();
            $table->string('currency')->default('USD');
            $table->float('price', 8, 2)->default(0);
            $table->float('discount',8,2)->default(0);
            $table->float('subtotal',8,2)->default(0);
            $table->float('tax',15,2)->default(0);
            $table->float('vat',15,2)->default(0);
            $table->float('amount',15,2)->default(0);
            $table->float('amount_paid',15,2)->default(0);
            $table->dateTime('pay_date', $precision = 0)->nullable()->useCurrent();
            $table->text('notes')->nullable();
            $table->boolean('adjusted')->default(false); // in case addon added for 3/6/12 month advance payment
            $table->date('adjustment_date')->nullable();
            $table->string('adjustment_ref')->nullable();
            /** ENUM */
            //$table->string('status')->default(LandlordInvoiceStatusEnum::DUE->value);
            /** end ENUM */
            /** ENUM */
            $table->string('status_code',4)->default(LandlordInvoiceStatusEnum::DUE->value); 
            $table->foreign('status_code')->references('code')->on('statuses');
            //$table->foreignId('status_id')->default(LandlordInvoiceStatusEnum::DUE->value)->constrained('statuses');
            /** end ENUM */
            //$table->boolean('enable')->default(true); 
            //$table->string('attachment')->nullable();
            $table->softDeletes();
            $table->biginteger('created_by')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->biginteger('updated_by')->default(1);
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
