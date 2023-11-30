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
        Schema::create('activities', function (Blueprint $table) {
            $table->id()->startingValue(10001);
            $table->string('object_name')->nullable();
            $table->string('object_id')->nullable()->default(''); 
            $table->string('event_name')->nullable(); 
            $table->string('column_name')->nullable(); 
            $table->string('prior_value')->nullable(); 
            $table->enum('object_type', ['C','M','O','E','H'])->default('C'); 
            $table->string('url');
            $table->string('method');
            $table->string('ip');
            $table->string('role')->nullable();
            $table->string('message')->nullable();
            $table->biginteger('user_id')->nullable();
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
        Schema::dropIfExists('activities');
    }
};
