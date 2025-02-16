<?php


// NOTES: https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9
namespace App\Traits;
use App\Models\User;
trait AddCreatedUpdatedBy
{
	// This functions name must start with boot
	public static function bootAddCreatedUpdatedBy()
	{
		// updating created_by and updated_by when model is created
		static::creating(function ($model) {
			if (!$model->isDirty('created_by')) {
				if (auth()->check()){
					$model->created_by = auth()->user()->id;
					$model->updated_by = auth()->user()->id;
				} else {
					// null
				}
			}

			if (!$model->isDirty('updated_by')) {
				if (auth()->check()){
					$model->updated_by = auth()->user()->id;
				} else {
					// null
				}
			}

		});

		// updating updated_by when model is updated
		static::updating(function ($model) {
			if (!$model->isDirty('updated_by')) {
				if (auth()->check()){
					$model->updated_by = auth()->user()->id;
				} else {
					// null
					//$model->updated_by = auth()->user()->id;
				}
			}
		});
	}

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
