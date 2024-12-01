<?php

namespace App\Traits;

use App\Models\User;

trait standardWhoColumn
{
	/* ---------------- created and updated by ---------------------- */
	public function user_created_by(){
		return $this->belongsTo(User::class,'created_by')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
	public function user_updated_by(){
		return $this->belongsTo(User::class,'updated_by')->withDefault([
			'name' => '[ Empty ]',
		]);
	}
}
