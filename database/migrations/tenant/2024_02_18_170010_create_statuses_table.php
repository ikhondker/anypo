<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Tenant\EntityEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		// aravel does not support Composite Primary Key
		Schema::create('statuses', function (Blueprint $table) {
			$table->string('code', 15);	// model: protected $primaryKey = 'entity';
			/** ENUM */
			//$table->string('entity')->default(EntityEnum::PR->value);
			/** end ENUM */
			//$table->id()->startingValue(1001);
			$table->string('name')->unique();
			//$table->string('message')->nullable();
			$table->string('badge')->nullable();
			$table->string('icon')->nullable();
			$table->boolean('enable')->default(true);
			//$table->softDeletes();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->primary('code');
			//$table->unique(['entity','code']);
			//$table->foreign('entity')->references('entity')->on('entities');
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
