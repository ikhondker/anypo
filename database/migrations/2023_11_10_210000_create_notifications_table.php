<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // https://medium.com/coding-tips-and-tutorials/solve-data-truncated-error-message-in-laravel-notifications-bf03d31c55c2
		Schema::create('notifications', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->string('type');
            //$table->morphs('notifiable');
            $table->uuid('notifiable_id');
            $table->string('notifiable_type');
			$table->text('data');
			$table->softDeletes();
			$table->timestamp('read_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('notifications');
	}
};
