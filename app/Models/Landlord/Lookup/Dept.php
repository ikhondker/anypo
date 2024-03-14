<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Dept.php
* @brief		This file contains the implementation of the Dept
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
namespace App\Models\Landlord\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;
use App\Models\Landlord\Ticket;


class Dept extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'name', 'enable', 'updated_at', 'updated_by'
	];

	/* ---------------- Functions ---------------------- */
	public static function getAll()
	{
		return Dept::select('id', 'name')
			->where('enable', true)
			->orderBy('id', 'asc')
			->get();
	}

	/* ---------------- Scope ---------------------- */
	
	
	/* ---------------- HasMany ---------------------- */
	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}

	/* ---------------- belongsTo ---------------------- */

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
