<?php

namespace App\Models;

use App\Enum\UserRoleEnum;

use App\Enum\TicketStatusEnum;

/*
|-----------------------------------------------------------------------------
| Landlord																	 +
|-----------------------------------------------------------------------------
*/
use App\Models\Landlord\Ticket;
use App\Models\Landlord\Account;
use App\Models\Landlord\Comment;
use App\Models\Landlord\Invoice;
use App\Models\Landlord\Payment;
use App\Models\Landlord\Service;
use App\Models\Landlord\Checkout;

use App\Models\Landlord\Lookup\Country;

use App\Models\Landlord\Manage\Activity;
use App\Models\Landlord\Manage\Template;
use App\Models\Landlord\Admin\Attachment;

/*
|-----------------------------------------------------------------------------
| Tenant																	 +
|-----------------------------------------------------------------------------
*/
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Designation;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\AddCreatedUpdatedBy;

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// IQBAL MustVerifyEmail
class User extends Authenticatable implements MustVerifyEmail
{
	use HasUuids;
	use HasApiTokens;
	use HasFactory;
	use Notifiable;
	use AddCreatedUpdatedBy;


	protected $keyType		= 'string';
	public $incrementing 	= false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */

	 // This will be merger of two separate User table in tenant and Landlord
	protected $fillable = [
		// common columns
		'name', 'email', 'role', 'password', 'email_verified_at', 'remember_token', 'cell', 'title', 'address1', 'address2', 'city', 'state', 'zip', 'country',
		'website','facebook', 'linkedin', 'avatar', 'notes', 'timezone',
		'backend', 'enable', 'locked', 'last_login_at', 'last_login_ip', 'updated_by', 'updated_at',
		// landlord column
		'account_id',
		// Tenant column
		'designation_id', 'dept_id', 'unit_id', 'remember_token',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at'	=> 'datetime',
		'password'			=> 'hashed',
		'last_login_at'		=> 'datetime',
		'updated_at'		=> 'datetime',
		'created_at'		=> 'datetime',
		'role'				=> UserRoleEnum::class
	];


	/* ----------------- Functions ---------------------- */
	/* ----------------- Scopes ------------------------- */
	/* ----------------- HasMany ------------------------ */
	/* ----------------- belongsTo ---------------------- */

	/*
	|-----------------------------------------------------------------------------
	| Common																	 +
	|-----------------------------------------------------------------------------
	*/


	/*
	|-----------------------------------------------------------------------------
	| Landlord																	 +
	|-----------------------------------------------------------------------------
	*/

	/* ---------------- Functions ---------------------- */
	public static function getAllLandlord() {
		return User::select('id','name')
			->where('enable', true)
			->orderBy('id','asc')
			->get();
	}

	public static function getAllAgent() {
		return User::select('id','name')
			->where('enable', true)
			->where('role', 'support')
			->orderBy('id','asc')
			->get();
	}

	public static function getOwners($account_id) {
		return User::select('id','name')
			->where('enable', true)
			->where('account_id', $account_id)
			->orderBy('id','asc')
			->get();
	}

	/*
	|-----------------------------------------------------------------------------
	| Policy Related Functions Common (both Landlord and Tenant) 				+
	|-----------------------------------------------------------------------------
	*/

	// usages auth()->user()->isAdmin()

	public function isBackend()
	{
		return $this->backend;
	}

	public function isUser()
	{
		if ($this->role->value == UserRoleEnum::USER->value) {
			return true;
		} else {
			return false;
		}
	}

	public function isAdmin()
	{
		if ($this->role->value == UserRoleEnum::ADMIN->value) {
			return true;
		} else {
			return false;
		}
	}

	public function isSupport()
	{

		if ($this->role->value == UserRoleEnum::SUPPORT->value
		|| $this->role->value == UserRoleEnum::SUPERVISOR->value
		|| $this->role->value == UserRoleEnum::SYS->value ) {		// Added later to skip before
			return true;
		} else {
			return false;
		}
	}

	public function isSys()
	{
		if ($this->role->value == UserRoleEnum::SYS->value) {
			return true;
		} else {
			return false;
		}
	}

	public function isSystem()
	{
		if ($this->role->value == UserRoleEnum::SYS->value) {
			return true;
		} else {
			return false;
		}
	}

	public function isDeveloper()
	{
		if ($this->role->value == UserRoleEnum::DEVELOPER->value) {
			return true;
		} else {
			return false;
		}
	}

	public function isAccounts()
	{
		if ($this->role->value == UserRoleEnum::ACCOUNTS->value) {
			return true;
		} else {
			return false;
		}
	}



	/*
	|-----------------------------------------------------------------------------
	| Policy Related Functions (Landlord)		 									+
	|-----------------------------------------------------------------------------
	*/



	/*
	|-----------------------------------------------------------------------------
	| Policy Related Functions (Tenant)		 									+
	|-----------------------------------------------------------------------------
	*/
	// usages auth()->user()->isSuperior()
	public function isSuperior()
	{
		if ($this->role->value == UserRoleEnum::BUYER->value
			|| $this->role->value == UserRoleEnum::HOD->value
			|| $this->role->value == UserRoleEnum::CXO->value
			|| $this->role->value == UserRoleEnum::ADMIN->value
			|| $this->role->value == UserRoleEnum::SUPPORT->value
			|| $this->role->value == UserRoleEnum::SYS->value
			) {
			return true;
		} else {
			return false;
		}
	}

	// usages auth()->user()->isBuyer()
	public function isBuyer()
	{
		if ($this->role->value == UserRoleEnum::BUYER->value) {
			return true;
		} else {
			return false;
		}
	}

	public function isHoD()
	{
		if ($this->role->value == UserRoleEnum::HOD->value) {
			return true;
		} else {
			return false;
		}
	}

	public function isCxO()
	{
		if ($this->role->value == UserRoleEnum::CXO->value) {
			return true;
		} else {
			return false;
		}
	}


	/* ----------------- Scopes ------------------------- */


	/*
	|-----------------------------------------------------------------------------
	| Scopes Common (both Landlord and Tenant) 				+
	|-----------------------------------------------------------------------------
	*/

	/**
	 * Scope a query to only All Approved PR for tenant.
	*/
	public function scopePrimary(Builder $query): void
	{
		$query->where('backend', false)
		->where('enable', true)
		->orderBy('name', 'asc');
	}



	/*
	|-----------------------------------------------------------------------------
	| Scopes for (Landlord) 													+
	|-----------------------------------------------------------------------------
	*/

	public function scopeLandlordAllEnable(Builder $query): void
	{
		$query->where('enable', true)
		->orderBy('name', 'asc');
	}

	/**
	 * Scope a query to only include current account users.
	 */
	public function scopeByAccount(Builder $query): void
	{
		$query->where('account_id', auth()->user()->account_id);
	}

	/**
	 * Scope a query to only include current users.
	*/
	public function scopeByUser(Builder $query): void
	{
		$query->where('id', auth()->user()->id);
	}

/*
	|-----------------------------------------------------------------------------
	| Scopes for (Tenant) 													+
	|-----------------------------------------------------------------------------
	*/

	/**
	 * Scope a query to only Tenant Active users.
	*/
	public function scopeTenant(Builder $query): void
	{
		$query->where('enable', true)
			->where('backend', false);
	}

	/**
	 * Scope a query to only tenant all non-backend users.
	*/
	public function scopeTenantAll(Builder $query): void
	{
		$query->where('backend', false);
	}

	public function scopeTenantAdmins(Builder $query): void
	{
		$query->where('role', UserRoleEnum::ADMIN->value)
			->where('enable', true)
			->where('backend', false)
			->orderBy('name', 'asc');
	}




	/**
	 * Scope a query to only non-backend users.
	*/
	public function scopeTenantInactive(Builder $query): void
	{
		$query->where('enable', false)
			->where('backend', false);
	}

	/**
	 * Scope a query to only non-backend users.
	*/
	public function scopeTenantAdmin(Builder $query): void
	{
		$query->where('backend', false)
			->where('role', UserRoleEnum::ADMIN->value );
	}

	/*
	|-----------------------------------------------------------------------------
	| ???   																	 +
	|-----------------------------------------------------------------------------
	*/


	/* ---------------- HasMany ---------------------- */
	public function contacts(): HasMany {
		return $this->hasMany(Contact::class,'user_id');
	}

	public function templates(): HasMany {
		return $this->hasMany(Template::class,'user_id');
	}

	// Get the activities for user a user.
	public function activity(): HasMany {
		return $this->hasMany(Activity::class,'user_id');
	}

	public function attachments(): HasMany {
		return $this->hasMany(Attachment::class,'owner_id');
	}

	public function checkouts(): HasMany {
		return $this->hasMany(Checkout::class,'owner_id');
	}

	// public function accounts(): HasMany {
	// 	return $this->hasMany(Account::class,'owner_id');
	// }

	public function services(): HasMany {
		return $this->hasMany(Service::class,'owner_id');
	}

	public function tickets(): HasMany {
		return $this->hasMany(Ticket::class,'owner_id');
	}

	public function agents(): HasMany {
		return $this->hasMany(Ticket::class,'agent_id');
	}

	// SAMPLE Get the comments for the blog post.
	public function comments(): HasMany {
		return $this->hasMany(Comment::class);
	}

	public function invoices(): HasMany {
		return $this->hasMany(Invoice::class,'owner_id');
	}

	public function payments(): HasMany {
		return $this->hasMany(Payment::class,'owner_id');
	}

	/* ---------------- belongsTo ---------------------- */
	public function account() {
		return $this->belongsTo(Account::class,'account_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function user_country() {
		return $this->belongsTo(Country::class,'country')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	/*
	|-----------------------------------------------------------------------------
	| Tenant																	 +
	|-----------------------------------------------------------------------------
	*/

	/* ----------------- Functions ---------------------- */







	/* ----------------- HasMany ------------------------ */


	// public function activity(): HasMany
	// {
	// 	return $this->hasMany(Activity::class, 'user_id');
	// }

	public function setup(): HasMany
	{
		return $this->hasMany(Setup::class, 'admin_id');
	}

	// public function templates(): HasMany
	// {
	// 	return $this->hasMany(Template::class, 'user_id');
	// }

	// public function attachments(): HasMany
	// {
	// 	return $this->hasMany(Attachment::class, 'owner_id');
	// }

	public function projects(): HasMany
	{
		return $this->hasMany(Project::class, 'pm_id');
	}

	// public function accounts(): HasMany
	// {
	// 	return $this->hasMany(Account::class, 'owner_id');
	// }

	// public function accountServices(): HasMany
	// {
	// 	return $this->hasMany(AccountService::class, 'owner_id');
	// }


	// public function agents(): HasMany
	// {
	// 	return $this->hasMany(Ticket::class, 'agent_id');
	// }

	// SAMPLE Get the comments for the blog post.
	// public function comments(): HasMany
	// {
	// 	return $this->hasMany(Comment::class);
	// }

	// public function invoices(): HasMany
	// {
	// 	return $this->hasMany(Invoice::class, 'owner_id');
	// }


	// public function payments(): HasMany
	// {
	// 	return $this->hasMany(Payment::class, 'owner_id');
	// }


	/* ----------------- belongsTo ---------------------- */
	public function country_name()
	{
		return $this->belongsTo(Country::class, 'country')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

	public function dept()
	{
		return $this->belongsTo(Dept::class, 'dept_id')->withDefault([
			'name' => '[ Empty ]',
		]);

	}

	public function designation()
	{
		return $this->belongsTo(Designation::class, 'designation_id')->withDefault([
			'name' => '[ Empty ]',
		]);

	}

	// =========== created and updated by =======================================================
	// TODO check
	public function dept_created_by() {
		return $this->hasMany(Dept::class,'created_by');
	}

	public function dept_updated_by() {
		return $this->hasMany(Dept::class,'updated_by');
	}

	public function setup_created_by() {
		return $this->hasMany(Setup::class,'created_by');
	}

	public function setup_updated_by() {
		return $this->hasMany(Setup::class,'updated_by');
	}

	public function country_created_by() {
		return $this->hasMany(Country::class,'created_by');
	}

	public function country_updated_by() {
		return $this->hasMany(Country::class,'updated_by');
	}

	public function entity_created_by() {
		return $this->hasMany(Entity::class,'created_by');
	}
	public function entity_updated_by() {
		return $this->hasMany(Entity::class,'updated_by');
	}

	public function attachment_created_by() {
		return $this->hasMany(Attachment::class,'created_by');
	}
	public function attachment_updated_by() {
		return $this->hasMany(Attachment::class,'updated_by');
	}

}

