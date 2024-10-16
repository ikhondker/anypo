<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			EntityEnum.php
* @brief		This file contains the implementation of the EntityEnum
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

// PR/PO Events
enum EventEnum: string{
	case CREATE		= 'create';
	case UPDATE		= 'update';
	case SUBMIT		= 'submit';
	//case FORWARD	= 'forward';
	case BOOK		= 'book';
	case POST		= 'post';	// Invoice
	case REJECT		= 'reject';
	case APPROVE	= 'approve';
	case CANCEL		= 'cancel';
	case RESET		= 'reset';
	//case ADJUST	= 'adjust';
	//case PAYMENT	= 'payment';
}


