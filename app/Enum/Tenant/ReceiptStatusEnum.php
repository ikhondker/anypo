<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			ReceiptStatusEnum.php
* @brief		This file contains the implementation of the ReceiptStatusEnum
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
namespace App\Enum\Tenant;

enum ReceiptStatusEnum:string{
	case RECEIVED	= 'received';
	case CANCELED	= 'canceled';
	case ERROR		= 'error';
	//case RETURNED	= 'returned';
}

