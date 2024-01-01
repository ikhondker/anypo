<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Dashboard.php
* @brief		This file contains the implementation of the Dashboard
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

// IQBAL 15-OCT-22
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Dashboard extends Model
{
	use HasFactory, AddCreatedUpdatedBy;
}
