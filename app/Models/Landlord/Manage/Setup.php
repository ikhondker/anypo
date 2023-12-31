<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// IQBAL 27-SEP-22
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Lookup\Country;

class Setup extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'tagline', 'currency', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'email', 'cell', 'website', 'facebook', 'linkedin', 'logo', 'show_banner', 'banner_message', 'discount_pc_3', 'discount_pc_6', 'discount_pc_12', 'discount_pc_24', 'days_gen_bill', 'days_due', 'days_overdue', 'days_archive', 'days_pay_for_addon', 'disable_payments', 'maintenance', 'debug', 'enable', 'updated_by', 'updated_at',
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
