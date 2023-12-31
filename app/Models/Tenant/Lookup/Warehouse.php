<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Country;

class Warehouse extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'contact_person', 'cell', 'address1', 'address2', 'city', 'zip', 'state', 'country', 'website', 'email', 'enable', 'updated_by', 'updated_at',
   ];
   

	/* ----------------- Functions ---------------------- */
	/* ----------------- HasMany ------------------------ */
	/* ---------------- belongsTo ---------------------- */
	public function relCountry(){
		return $this->belongsTo(Country::class,'country');
	}


}
