<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        AddCreatedUpdatedBy.php
 * @brief       This file contains the implementation of the AddCreatedUpdatedBy Trait.
 * @author      Iqbal H. Khondker 
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date         Version Author                  Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023  v1.0.0  Iqbal H Khondker        Created.
 * DD-Mon-YYYY  v1.0.0  Iqbal H Khondker        Modification brief.
 * ==================================================================================
*/

// NOTES: https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9
namespace App\Traits;

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
					$model->created_by = config('bo.GUEST_USER_ID');
					$model->updated_by = config('bo.GUEST_USER_ID');
				}
			}

			if (!$model->isDirty('updated_by')) {
				if (auth()->check()){
					$model->updated_by = auth()->user()->id;
				} else {
					$model->updated_by = config('bo.GUEST_USER_ID');
				}
			}
			
		});

		// updating updated_by when model is updated
		static::updating(function ($model) {
			if (!$model->isDirty('updated_by')) {
				if (auth()->check()){
					$model->updated_by = auth()->user()->id;
				} else {
					// TODO
					$model->created_by = config('bo.GUEST_USER_ID');
				}
				//$model->updated_by = auth()->user()->id;
			}
		});
	}
}