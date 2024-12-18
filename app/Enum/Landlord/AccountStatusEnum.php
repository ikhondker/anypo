<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			AccountStatusEnum.php
* @brief		This file contains the implementation of the AccountStatusEnum
* @path			\app\Enum
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
namespace App\Enum\Landlord;


enum AccountStatusEnum:string{
	case ACTIVE		= 'active';
	case INACTIVE	= 'in-active';
	case ONHOLD		= 'on-hold';
	case ARCHIVED	= 'archived';
	case READONLY	= 'readonly';
	case CANCELED	= 'canceled';
	case DELETED	= 'deleted';
	case LOCKED	 	= 'locked';
	case DEMO		= 'demo';
}
