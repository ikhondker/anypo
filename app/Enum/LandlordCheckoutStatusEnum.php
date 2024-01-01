<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			LandlordCheckoutStatusEnum.php
* @brief		This file contains the implementation of the LandlordCheckoutStatusEnum
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

enum LandlordCheckoutStatusEnum:string{
	case DRAFT		= '1002';
	case PROCESSING	= '1009';
	case COMPLETED	= '1013';
	case CANCELED	= '1020';
	case FAILED		= '1021';
	case ERROR		= '1022';
}
