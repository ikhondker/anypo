<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			PaymentMethodEnum.php
* @brief		This file contains the implementation of the PaymentMethodEnum
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

enum PaymentMethodEnum:string{
	case CASH		= '1001';  
	case CARD		= '1002';
	case MFS		= '1003';
	case CHECK		= '1004';
	case BANK		= '1005';
	case CRYPTO		= '1006';
}
