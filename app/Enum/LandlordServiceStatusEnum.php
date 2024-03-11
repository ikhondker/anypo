<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			LandlordServiceStatusEnum.php
* @brief		This file contains the implementation of the LandlordServiceStatusEnum
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

enum LandlordServiceStatusEnum:string{
	// case DRAFT		= '1002';
	// case ACTIVE		= '1003';
	// case PROCESSING	= '1009';
	// case CANCELED	= '1020';
	// case FAILED		= '1021';
	// case ERROR		= '1022';

	case DRAFT		= 'draft';
	case ACTIVE		= 'active';
	case PROCESSING	= 'processing';
	case CANCELED	= 'canceled';
	case FAILED		= 'failed';
	case ERROR		= 'error';
}
