<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			WfStatusEnum.php
* @brief		This file contains the implementation of the WfStatusEnum
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

enum WflActionEnum: string{
	case CREATED	= 'created';
	case SUBMITTED	= 'submitted';
	case DUE	  	= 'due';
	case PENDING	= 'pending';
	case APPROVED	= 'approved';
	case REJECTED	= 'rejected';
	case CANCELED	= 'canceled';
	// case FORWARD	= 'forward';
	//case DELEGATED	= 'delegated';
	//case QUESTION	= 'question';
	//case ANSWER		= 'answer';
}

