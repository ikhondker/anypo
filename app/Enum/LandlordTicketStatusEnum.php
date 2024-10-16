<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			LandlordTicketStatusEnum.php
* @brief		This file contains the implementation of the LandlordTicketStatusEnum
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
namespace App\Enum;

enum LandlordTicketStatusEnum:string{
	case NEW				= 'new';
	case ASSIGNED			= 'assigned';
	case PENDING			= 'pending';
	case INPROGRESS			= 'in-progress';
	case DEVELOPMENT		= 'development';
	case BUGFIXING			= 'bug-fixing';
	case CWIP				= 'cwip';
	case CLOSED				= 'closed';
	case ONHOLD				= 'on-hold';
}
