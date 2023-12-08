<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			WflActionEnum.php
* @brief		This file contains the implementation of the WflActionEnum
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

enum WfStatusEnum: string{
    case OPEN       = 'open';
    case CLOSED     = 'closed';
    case RESET      = 'reset';
    case INVALID    = 'invalid';
    case ERROR      = 'error';
    case CANCELED   = 'canceled';
}
