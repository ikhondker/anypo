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
		Schema::create('templates', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('code')->unique();
			$table->string('name');
			$table->text('summary');
			$table->foreignUuid('user_id')->constrained('users');
			$table->text('address1')->nullable();
			$table->text('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('US');
			$table->string('email',100);
			$table->string('cell',100)->nullable();
			$table->decimal('qty', 19, 4)->default(0);
			$table->decimal('amount',19, 2)->default(0);
			$table->text('notes')->nullable();
			$table->boolean('enable')->default(true);
			$table->date('my_date')->nullable()->useCurrent();
			$table->dateTime('my_date_time', $precision = 0)->nullable()->useCurrent();
			$table->enum('my_enum', ['user', 'admin','agent','manager','system'])->default('user');
			$table->string('my_url')->nullable();
			$table->string('logo')->nullable(); /* public */
			$table->string('avatar')->nullable(); /* private */
			$table->string('attachment')->nullable(); /* private */
			$table->string('fbpage')->nullable();
			$table->softDeletes();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('templates');
	}
};
