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
	case DRAFT		= 'draft';
	case PROCESSING	= 'processing';
	case COMPLETED	= 'completed';
	case CANCELED	= 'canceled';
	case FAILED		= 'failed';
	case ERROR		= 'error';


}
