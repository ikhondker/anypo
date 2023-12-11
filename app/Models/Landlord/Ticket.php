<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Ticket.php
* @brief		This file contains the implementation of the Ticket
* @path			\app\Models\Landlord
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Landlord\Lookup\Dept;
use App\Models\Landlord\Lookup\Priority;
use App\Models\Landlord\Lookup\Rating;
use App\Models\Landlord\Lookup\Status;

use App\Models\Landlord\Comment;

use App\Enum\LandlordTicketStatusEnum;

class Ticket extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'title', 'content', 'ticket_date', 'owner_id', 'account_id', 'dept_id', 'priority_id', 'rating_id', 'agent_id', 'attachment_id', 'status_code', 'is_answered', 'sla', 'due_date', 'is_overdue', 'closed', 'closed_at', 'is_deleted', 'reopened', 'reopened_at', 'approval', 'follow_up', 'last_message_at', 'last_response_at', 'link_ticket_id', 'ip', 'updated_by', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'ticket_date'   => 'datetime',
		'created_at'    => 'datetime',
		'status_code'     => LandlordTicketStatusEnum::class,
	];


	/* ---------------- Scope ---------------------- */
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopeByAccount(Builder $query): void
	{
		$query->where('account_id', auth()->user()->account_id);
	}
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopeByAccountOpen(Builder $query): void
	{
		$query->where('account_id', auth()->user()->account_id)
		->where('status_code', '<>', LandlordTicketStatusEnum::CLOSED->value);
	}
	/**
	 * Scope a query to only include current account users.
	 */
	public function scopeByAccountClosed(Builder $query): void
	{
		$query->where('account_id', auth()->user()->account_id)
		->where('status_code', LandlordTicketStatusEnum::CLOSED->value);
	}

	/**
	 * Scope a query to only include current users.
	 */
	public function scopeByUser(Builder $query): void
	{
		//$query->where('created_by', auth()->user()->id);
		$query->where('owner_id', auth()->user()->id);
	}

	/**
	 * Scope a query to only include current users.
	 */
	public function scopeByUserOpen(Builder $query): void
	{
		//$query->where('created_by', auth()->user()->id);
		$query->where('owner_id', auth()->user()->id)
			->where('status_code', '<>', LandlordTicketStatusEnum::CLOSED->value);
	}

	/**
	 * Scope a query to only include current users. 
	 */
	public function scopeByUserClosed(Builder $query): void
	{
		//$query->where('created_by', auth()->user()->id);
		$query->where('owner_id', auth()->user()->id)
			->where('status_code', LandlordTicketStatusEnum::CLOSED->value);
	}

	/**
	 * Scope a query to only include current users.
	 */
	public function scopeByAgentOpen(Builder $query): void
	{
		$query->where('agent_id', auth()->user()->id)
			->where('status_code', '<>', LandlordTicketStatusEnum::CLOSED->value);
	}

	/**
	 * Scope a query to only include current users.
	 */
	public function scopeByAgentClosed(Builder $query): void
	{
		$query->where('agent_id', auth()->user()->id)
			->where('status_code', LandlordTicketStatusEnum::CLOSED->value);
	}

	/**
	 * Scope a query to only include current users.
	 */
	public function scopeByUnassigned(Builder $query): void
	{
		$query->where('agent_id','=', NULL)
		->where('status_code', '<>', LandlordTicketStatusEnum::CLOSED->value);
	}
	/**
	 * Scope a query to only include current users.
	 */
	public function scopeByAllOpen(Builder $query): void
	{
		$query->where('status_code', '<>', LandlordTicketStatusEnum::CLOSED->value);
	}
	/**
	 * Scope a query to only include current users.
	 */
	public function scopeByAllClosed(Builder $query): void
	{
		$query->where('status_code', LandlordTicketStatusEnum::CLOSED->value);
	}
	/**
	 * Scope a query to only include current users.
	 */
	public function scopeByAllOnhold(Builder $query): void
	{
		$query->where('status_code', LandlordTicketStatusEnum::ONHOLD->value);
	}

	/* ---------------- HasMany ---------------------- */
	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	/* ---------------- belongsTo ---------------------- */
	public function dept()
	{
		return $this->belongsTo(Dept::class, 'dept_id');
	}

	public function priority()
	{
		return $this->belongsTo(Priority::class, 'priority_id');
	}

	public function ating()
	{
		return $this->belongsTo(Rating::class, 'rating_id');
	}

	public function status()
	{
		return $this->belongsTo(Status::class, 'status_code');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function agent()
	{
		return $this->belongsTo(User::class, 'agent_id');
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
