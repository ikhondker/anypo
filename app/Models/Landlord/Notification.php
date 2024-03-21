<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Notification.php
* @brief		This file contains the implementation of the Notification
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

class Notification extends Model
{
	use HasFactory;
	protected $primaryKey = 'id';
	protected $keyType = 'string';

	// NOTES: https://stackoverflow.com/questions/61844701/laravel-how-to-get-id-of-database-notification
	// protected $casts = [
	//	'data' => 'array',
	//	'id' => 'string'
	// ];

	protected $casts = [
		'data'		=> 'array',
		'id'		=> 'string',
	];

}
