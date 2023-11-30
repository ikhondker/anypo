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
        Schema::create('statuses', function (Blueprint $table) {
            $table->string('code',4);    //  model: protected $primaryKey = 'entity'; // Hardcoded in Workflow Helper only
            //$table->id()->startingValue(1001);
            $table->string('name');
            //$table->string('message')->nullable();
            $table->string('badge')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('accounts')->default(false);
            $table->boolean('services')->default(false);
            $table->boolean('tickets')->default(false);
            $table->boolean('checkouts')->default(false);
            $table->boolean('invoices')->default(false);
            $table->boolean('payments')->default(false);
            $table->boolean('notify_user')->default(false); 
            $table->boolean('email_user')->default(false); 
            $table->boolean('enable')->default(true); 
            //$table->softDeletes();
            $table->biginteger('created_by')->default(1001);
            $table->timestamp('created_at')->useCurrent();
            $table->biginteger('updated_by')->default(1001);
            $table->timestamp('updated_at')->useCurrent();
            $table->primary('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
