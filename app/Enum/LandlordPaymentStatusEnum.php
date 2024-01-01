<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			LandlordPaymentStatusEnum.php
* @brief		This file contains the implementation of the LandlordPaymentStatusEnum
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

enum LandlordPaymentStatusEnum:string{
	case DRAFT		= '1002';
	case PAID		= '1014';
	case CANCELED	= '1020';
	case FAILED		= '1021';
	case ERROR		= '1022';
}
