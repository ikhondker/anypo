<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Activity.php
* @brief		This file contains the implementation of the Activity
* @path			\app\Models\Landlord\Admin
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Activity extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'account_id', 'object_name', 'object_id', 'event_name', 'column_name', 'prior_value', 'object_type', 'url', 'method', 'ip', 'role', 'message', 'user_id', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
	];


	/* ---------------- Scope ---------------------- */
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopeByAccount(Builder $query): void
	{
		// TODOP2 CHECK
		$query->where('account_id', auth()->user()->account_id)
			->whereHas('user', function ($q) {
				$q->where('seeded', false);
		});

	}

	/* ---------------- HasMany ---------------------- */


	/* ---------------- belongsTo ---------------------- */
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id')->withDefault([
			'name' => '[ Guest ]',
		]);
	}
}
