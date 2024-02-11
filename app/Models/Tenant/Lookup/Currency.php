<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Lookup\PayMethod;
use Illuminate\Database\Eloquent\Builder;

class Currency extends Model
{
	use HasFactory, AddCreatedUpdatedBy;
	protected $primaryKey	= 'currency';
	protected $keyType		= 'string';

	protected $fillable = [
		'currency', 'name', 'country', 'symbol', 'enable', 'rates', 'never', 'updated_by', 'updated_at',
	];

	/* ----------------- Functions ---------------------- */
	public static function getActives() {
		return Currency::select('currency','name','country')
			->where('enable',true)
			->orderBy('name','asc')
			->get();
	}

	/* ----------------- Scopes ------------------------- */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true);
	}

	/* ----------------- HasMany ------------------------ */
	public function setup(): HasMany {
		return $this->hasMany(Setup::class,'currency');
	}

	public function paymethod(): HasMany {
		return $this->hasMany(PayMethod::class,'currency');
	}

	public function pr(): HasMany {
		return $this->hasMany(Pr::class,'currency');
	}

	public function po(): HasMany {
		return $this->hasMany(Po::class,'currency');
	}

	/* ---------------- belongsTo ---------------------- */
}
