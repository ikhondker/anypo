<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Category.php
* @brief		This file contains the implementation of the Category
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

// IQBAL 27-SEP-22
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Category extends Model
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

	/* ---------------- HasMany ---------------------- */


	/* ---------------- belongsTo ---------------------- */

}
