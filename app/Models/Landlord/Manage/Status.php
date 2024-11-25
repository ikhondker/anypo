<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Status.php
* @brief		This file contains the implementation of the Status
* @path			\app\Models\Landlord\Lookup
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
namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Ticket;

class Status extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $primaryKey	= 'code';
	protected $keyType		= 'string';

	protected $fillable = [
		'name', 'badge', 'icon', 'accounts', 'tickets', 'checkouts', 'invoices', 'payments', 'notify_user', 'email_user', 'enable', 'updated_by', 'updated_at',
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

	/* ---------------- Scope ---------------------- */


	/* ---------------- HasMany ---------------------- */
	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}

	/* ---------------- belongsTo ---------------------- */

}
