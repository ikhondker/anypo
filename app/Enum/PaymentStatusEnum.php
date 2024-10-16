<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			PaymentStatusEnum.php
* @brief		This file contains the implementation of the PaymentStatusEnum
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

enum PaymentStatusEnum:string{
	case DUE		= 'due';
	//case UNPAID	= 'unpaid';
	case PARTIAL	= 'partial';
	case PAID		= 'paid';
	case CANCELED	= 'canceled';
	case ERROR		= 'error';
}
