<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tenant;

class Domain extends Model
{
	use HasFactory;

	/* ---------------- belongsTo ---------------------- */
	public function tenant(){
		return $this->belongsTo(Tenant::class,'tenant_id');
	}

}
