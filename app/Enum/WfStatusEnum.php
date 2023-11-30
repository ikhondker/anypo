<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        WfStatusEnum.php
 * @brief       This file contains the implementation of the WfStatusEnum Enum.
 * @author      Iqbal H. Khondker 
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Jul-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
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
