<?php

namespace App\Models\Tenant\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// IQBAL 27-SEP-22
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Lookup\Country;
use App\Models\Tenant\Lookup\Currency;

class Setup extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name','system_user_id', 'tagline', 'currency', 'freezed', 'tax_pc', 'gst_pc', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'email', 'cell', 'website', 'facebook', 'linkedin', 'days_payment', 'days_return', 'tolerance_invoice', 'tolerance_receipt', 'tolerance_payment', 'user_master_data_entry', 'ac_accrual', 'ac_liability', 'ac_clearing', 'tc', 'logo', 'banner_show', 'banner_message', 'version', 'build', 'admin_id', 'kam_id', 'landlord_account_id', 'last_rate_date', 'maintenance', 'debug', 'readonly', 'enable', 'updated_by', 'updated_at',
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
