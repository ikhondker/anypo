<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Contact.php
* @brief		This file contains the implementation of the Contact
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
namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

use Notification;

//use App\Notifications\Contacted;


use App\Models\User;

class Contact extends Model
{
	use HasFactory, Notifiable;

	public $fillable = [
		'type', 'first_name', 'last_name', 'email', 'cell', 'subject', 'message', 'contact_date', 'tenant', 'user_id', 'attachment_id', 'ip', 'country', 'updated_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'contact_date'     => 'datetime',
	];

	/* ---------------- HasMany ---------------------- */


	/* ---------------- belongsTo ---------------------- */
	public function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/* ---------------- created and updated by ---------------------- */
}
