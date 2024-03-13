<?php

namespace App\Models\Tenant\Admin;

/* IQBAL 21-OCT-22 */
use App\Traits\AddCreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

use App\Models\User;

class Activity extends Model
{
	use HasFactory;
	use AddCreatedUpdatedBy;

	protected $fillable = [
		'object_name', 'object_id', 'event_name', 'column_name', 'prior_value', 'object_type', 'url', 'method', 'ip', 'role', 'message', 'user_id', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'updated_at' => 'datetime',
		'created_at' => 'datetime',
	];

	/* ----------------- Functions ---------------------- */
	/* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only  non-seeded users.
	 */
	public function scopePrimary(Builder $query): void
	{
		//$query->where('user_id','>=', 1003);
		$query->whereHas('user', function ($q) {
				$q->where('seeded', false);
		});

	}


	/* ----------------- HasMany ------------------------ */
	/* ----------------- belongsTo ---------------------- */
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
