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
        Schema::create('pols', function (Blueprint $table) {
            $table->id()->startingValue(1001);
            $table->foreignId('po_id')->constrained('pos');
            $table->biginteger('line_num')->default(0);
            $table->foreignId('project_id')->constrained('projects')->nullable();
            $table->string('summary');
            $table->foreignId('item_id')->constrained('items');
            $table->text('notes')->nullable();
            $table->float('qty')->default(1);
            //$table->foreignId('uom_id')->constrained('uoms');
            $table->float('price')->default(0);
            $table->float('sub_total')->default(0);
            $table->float('tax')->default(0);
            $table->float('vat')->default(0);
            $table->float('amount')->default(0);
            $table->float('receive_qty')->default(0);
            $table->boolean('open')->default(true); 
            $table->boolean('asset_created')->default(false); 
            $table->date('asset_date')->nullable();
            $table->softDeletes();
            $table->biginteger('created_by')->default(1001);
            $table->timestamp('created_at')->useCurrent();
            $table->biginteger('updated_by')->default(1001);
            $table->timestamp('updated_at')->useCurrent();        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pols');
    }
};
