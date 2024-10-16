<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Tenant\WfStatusEnum;
use App\Enum\Tenant\AuthStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('wfs', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('entity',15);
			$table->integer('article_id')->default(1);
			$table->integer('hierarchy_id')->default(1);
			/** ENUM */
			$table->string('wf_status')->default(WfStatusEnum::OPEN->value);
			/** end ENUM */
			/** ENUM */
			$table->string('auth_status')->default(AuthStatusEnum::DRAFT->value);
			/** end ENUM */
			$table->integer('auth_user_id')->nullable();
			$table->dateTime('auth_date',)->nullable();
			$table->string('error_code',15)->nullable();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->foreign('entity')->references('entity')->on('entities');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('wfs');
	}
};
