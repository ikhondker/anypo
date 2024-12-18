<?php

namespace App\Models\Tenant\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class Country extends Model
{

	use HasFactory, AddCreatedUpdatedBy;
	protected $primaryKey	= 'country';
	protected $keyType		= 'string';

	protected $fillable = [
		 'country','name','enable','updated_at','updated_by'
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

	/* ----------------- Functions ---------------------- */
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true);
	}


	/* ----------------- HasMany ------------------------ */
	public function users(): HasMany {
		return $this->hasMany(User::class,'country');
	}

	/* ---------------- belongsTo ---------------------- */


	/* ---------------- created and updated by ---------------------- */


	public function user_created_by(){
		return $this->belongsTo(User::class,'created_by');
	}
	public function user_updated_by(){
		return $this->belongsTo(User::class,'updated_by');
	}
}
