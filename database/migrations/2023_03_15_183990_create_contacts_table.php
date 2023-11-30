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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id()->startingValue(1001);
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->enum('type', ['general', 'bug','feature','other'])->default('general'); 
            $table->string('subject');
            $table->text('message');
            $table->dateTime('contact_date')->useCurrent();
            $table->foreignId('owner_id')->nullable()->constrained('users');
            $table->foreignId('attachment_id')->nullable()->constrained('attachments');
            $table->string('ip');
            $table->string('country',2)->default('us');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
