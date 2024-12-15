<?php

namespace App\Models\Tenant\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Lookup\Country;
use App\Models\Tenant\Lookup\Currency;

class Setup extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'tagline', 'currency', 'freezed', 'prefix', 'tax_pc', 'gst_pc', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'email', 'cell', 'website', 'facebook', 'linkedin', 'timezone', 'days_payment', 'days_return', 'tolerance_invoice', 'tolerance_receipt', 'tolerance_payment', 'user_master_data_entry', 'ac_advance', 'ac_ap_accrual', 'ac_liability', 'tc', 'logo', 'banner_show', 'banner_message', 'admin_id', 'system_user_id', 'kam_id', 'landlord_account_id', 'last_rate_date', 'maintenance', 'demo', 'debug', 'readonly', 'enable', 'version', 'build', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'last_rate_date'	=> 'datetime',
		'updated_at'		=> 'datetime',
		'created_at'		=> 'datetime',
	];


	/* ----------------- HasMany ------------------------ */


	/* ---------------- belongsTo ---------------------- */
	public function country_name(){
		return $this->belongsTo(Country::class,'country')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function relCurrency(){
		return $this->belongsTo(Currency::class,'currency')->withDefault([
			'currency' => '[ Empty ]',
		]);
	}

	public function admin_user(){
		return $this->belongsTo(User::class,'admin_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	/* ---------------- created and updated by ---------------------- */
	public function user_created_by(){
		return $this->belongsTo(User::class,'created_by');
	}
	public function user_updated_by(){
		return $this->belongsTo(User::class,'updated_by');
	}

}
