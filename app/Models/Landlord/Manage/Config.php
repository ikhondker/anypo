<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// IQBAL 27-SEP-22
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Lookup\Country;

class Config extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'tagline', 'currency', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'email', 'cell', 'website', 'facebook', 'linkedin', 'logo', 'banner', 'banner_message', 'maintenance', 'maintenance_start_time', 'maintenance_end_time', 'debug', 'disable_payments', 'version', 'build', 'days_gen_bill', 'days_due', 'days_past_due', 'days_addon_free', 'days_archive', 'discount_pc_3', 'discount_pc_6', 'discount_pc_12', 'discount_pc_24', 'system_user_id', 'support_manager_id', 'enable', 'updated_by', 'updated_at',
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

	/* ---------------- HasMany ---------------------- */

	/* ---------------- belongsTo ---------------------- */
	public function relCountry()
	{
		// don change the relation name from relCountry to country
		return $this->belongsTo(Country::class, 'country');
	}

	/* ---------------- created and updated by ---------------------- */
	public function user_created_by()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
	public function user_updated_by()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}
}
