<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Priority extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
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


	/* ---------------- Functions ---------------------- */
	public static function getAll()
	{
		return Priority::select('id', 'name')
			->where('enable', true)
			->orderBy('id', 'asc')
			->get();
	}

	/* ---------------- HasMany ---------------------- */
	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}

	/* ---------------- belongsTo ---------------------- */



}
