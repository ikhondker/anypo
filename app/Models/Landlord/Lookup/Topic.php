<?php

namespace App\Models\Landlord\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Landlord\Manage\TicketTopic;

use Illuminate\Database\Eloquent\Builder;

class Topic extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
	];

	protected $casts = [
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
	];

    /* ----------------- Scopes ------------------------- */
	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopePrimary(Builder $query): void
	{
		$query->where('enable', true)->orderBy('name', 'asc');
	}

    /* ---------------- HasMany ---------------------- */
	public function ticketTopics()
	{
		return $this->hasMany(TicketTopic::class);
	}

}
